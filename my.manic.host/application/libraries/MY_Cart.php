<?php
/**
 * Created by PhpStorm.
 * User: iann0036
 * Date: 23/3/2015
 * Time: 11:59 PM
 */

class MY_Cart extends CI_Cart {
    public $CI;

    function __construct() {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->library('order');
        $this->CI->load->helper('mail');
        $this->CI->load->model('Invoices_model');
    }

    private function _is_identical($a, $b) {
        sort($a);
        sort($b);

        return $a == $b;
    }

    public function isDomainInCart($domain) {
        foreach ($this->contents() as $item) {
            if (substr($item['id'],0,19)=="domain_registration") {
                if ($item['options']['domain']==$domain)
                    return true;
            }
        }

        return false;
    }

    public function insert($data) {
        foreach ($this->contents() as $item) {
            if ($item['id']==$data['id'] && $this->_is_identical($item['options'],$data['options'])) {
                $update_data = array(
                    'rowid' => $item['rowid'],
                    'qty'   => ($item['qty']+1)
                );
                $this->update($update_data);
                return $item['rowid'];
            }
        }
        return parent::insert($data);
    }

    public function process($admin_details, $billing_details, $tech_details) {
        ignore_user_abort(true); // unstoppable
        set_time_limit(86400);   // ...within reason

        if ($this->total_items()<1) {
            return;
        }

        $success = false;

        if ($this->CI->input->post('stripeToken')) {
            $payment_id = $this->CI->input->post('payment_id');
            $price = $this->total()*100;

            \Stripe\Stripe::setApiKey("SNIPPED");
            try {
                $charge_return = \Stripe\Charge::create(array(
                    "amount" => $price,
                    "currency" => "usd",
                    "source" => $this->CI->input->post('stripeToken'),
                    "receipt_email" => "admin@manic.host"
                ), array(
                    'idempotency_key' => $payment_id
                ));

                if ($charge_return->status=="succeeded") {
                    $success = true;
                    $card_padding = "#### #### #### ";
                    if ($charge_return->source->brand=="american express")
                        $card_padding = "#### ###### #";
                    $payment_details = array(
                        'type' => strtoupper($charge_return->source->brand),
                        'detail' => $card_padding.$charge_return->source->last4,
                        'status' => 'PAID $'.(number_format(($charge_return->amount/100),2))
                    );
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
                error_log($error);
            }
        }

        if (!$success)
            redirect('/error/');

        $email = $this->CI->session->userdata('email');

        $invoice_no = $this->CI->Invoices_model->addInvoice($this->total());

        $this->_generateInvoice($invoice_no, $billing_details, $payment_details);
        if (strlen($email)>0)
            sendInvoiceMail($email, $this->CI->session->userdata('name'), $invoice_no);
        if ($email!=$billing_details['email'] && strlen($billing_details['email'])>0)
            sendInvoiceMail($billing_details['email'], $this->CI->session->userdata('name'), $invoice_no);

        $ch = \Stripe\Charge::retrieve($charge_return->id);
        $ch->description = "Invoice #".$invoice_no;
        $ch->save();

        $contents = $this->contents();

        $this->destroy();

        $this->CI->order->run($this->CI->session->userdata('userid'),$admin_details, $billing_details, $tech_details, $payment_details, $contents); //////////////////////////////
    }

    public function _generateInvoice($invoice_no, $billing_details, $payment_details) {
        $cart_items = $this->contents();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator('Manic Host');
        $pdf->SetAuthor('Manic Host');
        $pdf->SetTitle('Invoice #'.$invoice_no);

        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(10,10,10);
        $pdf->SetLeftMargin(10);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->setFontSubsetting(true);
        $pdf->AddPage();

        $pdf->SetLineStyle(array(
            'color' => array(200,200,200)
        ));

        $pdf->Image('http://my.manic.host/assets/img/logo_250_no_left_margin.png');
        $pdf->SetFont('dejavusans', '', 18, '', true);
        $pdf->SetY(15);
        $pdf->Cell(150);
        $pdf->Cell(40, 0, "Invoice", 0, 0, 'R');

        $pdf->SetY(32);
        $pdf->SetFont('dejavusans', 'B', 10, '', true);
        $pdf->Cell(130, 0, "Manic Host");
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(130, 0, "E-mail: billing@manic.host");
        $pdf->Ln();
        $pdf->Cell(130, 0, "ABN: 47 479 489 099");

        $pdf->SetY(32);
        $pdf->Cell(130);
        $pdf->Cell(30, 10, "Date:", 1, 0, 'C');
        $pdf->Cell(30, 10, date('d/m/Y', time()), 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(130);
        $pdf->Cell(30, 10, "Invoice #:", 1, 0, 'C');
        $pdf->Cell(30, 10, $invoice_no, 1, 0, 'C');
        $pdf->Ln();

        $pdf->Ln();

        $pdf->SetFont('dejavusans', 'B', 10, '', true);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(70, 10, " Bill To", 1, 0, '', true);
        $pdf->Cell(5);
        $pdf->Cell(70, 10, " Payment Info", 1, 0, '', true);
        $pdf->Ln();

        $y = $pdf->GetY();

        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->SetFillColor(255);
        if (strlen($billing_details['address2'])<1)
            $pdf->MultiCell(70, 22, "\n ".$billing_details['firstname']." ".$billing_details['lastname']."\n ".$billing_details['address1'].
                "\n ".$billing_details['city']."\n ".$billing_details['state'].", ".
                $billing_details['postcode'].", ".$billing_details['country']."\n", 1, '');
        else
            $pdf->MultiCell(70, 22, " ".$billing_details['firstname']." ".$billing_details['lastname']."\n ".$billing_details['address1'].
                "\n ".$billing_details['address2']."\n ".$billing_details['city']."\n ".$billing_details['state'].", ".
                $billing_details['postcode'].", ".$billing_details['country']."\n", 1, '');
        $prev_y = $pdf->GetY();
        $pdf->Cell(5);
        $pdf->MultiCell(70, 22, "\n ".$payment_details['type']."\n ".$payment_details['detail']."\n ".$payment_details['status']."\n", 1, "", false, 1, 85, $y);
        $pdf->SetY($prev_y+10);

        function tableHead($pdf) {
            $pdf->SetFont('dejavusans', 'B', 10, '', true);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->Cell(110, 10, " Item", 1, 0, '', true);
            $pdf->Cell(30, 10, " Price", 1, 0, 'C', true);
            $pdf->Cell(15, 10, " Qty", 1, 0, 'C', true);
            $pdf->Cell(35, 10, " Total Price", 1, 0, 'C', true);
            $pdf->SetFont('dejavusans', '', 10, '', true);
            $pdf->Ln();
        }
        tableHead($pdf);

        foreach ($cart_items as $item) {
            foreach ($this->product_options($item['rowid']) as $option_name => $option_value)
                $item[$option_name] = $option_value;
            if ($pdf->GetY()>250) {
                $pdf->AddPage();
                $pdf->setPage($pdf->getPage());
                tableHead($pdf);
            }
            if ($item['months']==1)
                $period_length = "1 Month";
            else if ($item['months']==12)
                $period_length = "1 Year";
            else
                $period_length = ($item['months']/12)." Years";

            if (isset($item['domain']))
                $item['name'].=" (".$item['domain'].")";
            else if (isset($item['email_address']))
                $item['name'].=" (".$item['email_address'].")";
            else if (isset($item['hostname']))
                $item['name'].=" (".$item['hostname'].")";

            $pdf->MultiCell(110, 18, "\n ".$item['name']." - ".$period_length."\n", 1, '', false, 0);
            $pdf->Cell(30, 18, " $".number_format($item['price'],2), 1);
            $pdf->Cell(15, 18, $item['qty'], 1, 0, 'C');
            $pdf->Cell(35, 18, " $".number_format($item['price'],2), 1);
            $pdf->Ln();
        }

        if ($pdf->GetY()>250) {
            $pdf->AddPage();
            $pdf->setPage($pdf->getPage());
            tableHead($pdf);
        }
        $pdf->Cell(155, 10, "Subtotal: ", 1, 0, 'R');
        $pdf->Cell(35, 10, " $".number_format($this->total(),2), 1);
        $pdf->Ln();
        $pdf->Cell(155, 10, "Tax: ", 1, 0, 'R');
        $pdf->Cell(35, 10, " $0.00", 1);
        $pdf->Ln();
        $pdf->SetFont('dejavusans', 'B', 12, '', true);
        $pdf->Cell(155, 10, "Total: ", 1, 0, 'R');
        $pdf->Cell(35, 10, " $".number_format($this->total(),2), 1);
        $pdf->SetFont('dejavusans', '', 10, '', true);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Cell(190, 0, "All pricing is displayed and charged in United States Dollar (USD).", 0, 0, 'C');

        $pdf->Output('/var/www/my.manic.host/invoices/Invoice_'.$invoice_no.'.pdf', 'F');
    }
}