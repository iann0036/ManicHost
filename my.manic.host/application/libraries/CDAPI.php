<?php defined('BASEPATH') or exit('No direct script access allowed');

    define('RESELLER_ID', SNIPPED);
    define('API_KEY', 'SNIPPED');
    define('SOAP_LOCATION', 'http://soap.secureapi.com.au/API-1.1');
    define('WSDL_LOCATION', 'http://soap.secureapi.com.au/wsdl/API-1.1.wsdl');

    class CDAPI {
        private $reseller_api_soap_client;
        private $prices = null;

        function __construct($reseller_id = RESELLER_ID, $api_key = API_KEY) {
            //set the login headers
            $authenticate = array();
            $authenticate['AuthenticateRequest'] = array();
            $authenticate['AuthenticateRequest']['ResellerID'] = $reseller_id;
            $authenticate['AuthenticateRequest']['APIKey'] = $api_key;

            //convert $authenticate to a soap variable
            $authenticate['AuthenticateRequest'] = new SoapVar($authenticate['AuthenticateRequest'], SOAP_ENC_OBJECT);
            $authenticate = new SoapVar($authenticate, SOAP_ENC_OBJECT);

            $header = new SoapHeader(SOAP_LOCATION, 'Authenticate', $authenticate, false);

            $this->reseller_api_soap_client = new SoapClient(WSDL_LOCATION, array('soap_version' => SOAP_1_2, 'cache_wsdl' => WSDL_CACHE_NONE));
            $this->reseller_api_soap_client->__setSoapHeaders(array($header));
        }

        function _call($method, $data = null) {
            $prepared_data = $data != null ? array($data) : array();

            try {
                $response = $this->reseller_api_soap_client->__soapCall($method, $prepared_data);
            } catch (SoapFault $response) { }

            return $response;
        }

        function _getPrices() {
            $response = $this->_call('GetDomainPriceList');
            $this->prices = $response->APIResponse->DomainPriceList;
        }

        function _addValue($price) {
            return ceil($price*1.035+0.3);
        }

        function checkTransfer($domain, $epp) {
            $parts = explode(".",$domain);
            if (count($parts)==2) {
                $prefix = $parts[0];
                array_shift($parts);
                $tld = implode(".",$parts);
            } else
                return array('success' => false, 'error' => 'Invalid domain name');

            $request = array(
                'DomainName' => $domain,
                'AuthKey' => $epp
            );

            $response = $this->_call('TransferCheck', $request);

            if (!is_soap_fault($response)) {
                if (isset($response->APIResponse->IsEligibleForRenewal)) {
                    if ($response->APIResponse->IsEligibleForRenewal==true) {
                        $this->_getPrices();
                        foreach ($this->prices as $item) {
                            if ($item->Product==$tld) {
                                return array('success' => true, 'price' => $this->_addValue($item->Price), 'min_years' => $item->MinimumPeriod);
                            }
                        }
                    }
                }
            }

            return array('success' => false, 'error' => 'An internal error');
        }

        function createContact($fname, $lname, $addr, $city, $state, $country, $pcode, $ccode, $phone, $mobile, $email, $type = 'personal', $bname = null, $btype = null, $bnum = null) {
            $request = array(
                'FirstName' => $fname,
                'LastName' => $lname,
                'Address' => $addr,
                'City' => $city,
                'Country' => $country,
                'State' => $state,
                'PostCode' => $pcode,
                'CountryCode' => $ccode,
                'Phone' => $phone,
                'Mobile' => $mobile,
                'Email' => $email,
                'AccountType' => $type
            );
            if ($type=='business') {
                $request['BusinessName'] = $bname;
                $request['BusinessNumberType'] = $btype;
                $request['BusinessNumber'] = $bnum;
            }

            $response = $this->_call('ContactCreate', $request);

            if (!is_soap_fault($response)) {
                if (isset($response->APIResponse->ContactDetails)) {
                    return $response->APIResponse->ContactDetails->ContactIdentifier;
                }
            }

            return false;
        }

        function createResistrantFromContact($contact_id) {
            $request = array(
                'ContactIdentifier' => $contact_id
            );

            $response = $this->_call('ContactCloneToRegistrant', $request);

            if (!is_soap_fault($response)) {
                if (isset($response->APIResponse->ContactDetails)) {
                    return $response->APIResponse->ContactDetails->ContactIdentifier;
                }
            }

            return false;
        }

        function registerDomain($domain, $years = 1, $admin_id = 'C-007562807-SN', $billing_id = 'C-007562807-SN', $tech_id = 'C-007562807-SN', $registrant_id = null) {
            if ($registrant_id==null) {
                $registrant_id = $this->createResistrantFromContact($admin_id);
                error_log($registrant_id);
                if ($registrant_id==false)
                    return false;
            }

            $nameservers = array(
                array(
                    'Host' => 'ns1.manic.host',
                    'IP' => gethostbyname('ns1.manic.host')
                ),
                array(
                    'Host' => 'ns2.manic.host',
                    'IP' => gethostbyname('ns2.manic.host')
                ),
                array(
                    'Host' => 'ns3.manic.host',
                    'IP' => gethostbyname('ns3.manic.host')
                ),
                array(
                    'Host' => 'ns4.manic.host',
                    'IP' => gethostbyname('ns4.manic.host')
                )
            );

            $request = array(
                'DomainName' => $domain,
                'RegistrantContactIdentifier' => $registrant_id,
                'AdminContactIdentifier' => $admin_id,
                'BillingContactIdentifier' => $billing_id,
                'TechContactIdentifier' => $tech_id,
                'RegistrationPeriod' => $years,
                'NameServers' => $nameservers
            );

            $response = $this->_call('DomainCreate', $request);

            if (!is_soap_fault($response)) {
                if (isset($response->APIResponse->DomainDetails)) {
                    return true;
                }
            }

            return false;
        }
    }