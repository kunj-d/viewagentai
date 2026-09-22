<?php
class GlobalVar
{
  const KEY = '596c9230e4b0b54461d31805';
  const SECRET = 'vWiSDph5KxjMxaXTzE6IFllrML2';

  public static function getKey() {
    return self::KEY;
  }

  public static function getSecret() {
    return self::SECRET;
  }
}


$credential = GlobalVar::KEY.':'.GlobalVar::SECRET;
include('contacts.php');

//Credebtial Authontication
function checkcredentialorize($credential)
	{
		$url = "https://api.salesforceiq.com/v2/accounts";
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$json_response = curl_exec($curl);
		if (is_object(json_decode($json_response))) 
			{ 
				$array = array('success'=>1);
			}
			else
			{
				$array = array('success'=>0);
			}
		return json_encode($array);
		curl_close ($curl);
		
	}
	
//Access All Account
	function getAllAccount($credential)
	{
		$url = "https://api.salesforceiq.com/v2/accounts";
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		
	}
	
//Access All List Data
	function getAllList($credential)
	{
		$url = "https://api.salesforceiq.com/v2/lists";
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		
	}

//Access All Contact	
	function getAllContacts($credential)
	{
		$url = "https://api.salesforceiq.com/v2/contacts";
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		
	}

//Access  Contact By Limit	
	function getAllContact_by_limit($credential,$start,$limit)
	{
		$url = "https://api.salesforceiq.com/v2/contacts?_start=".$start."&_limit=".$limit;
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		
	}
	
//Access Contact Filter By Phone Number
	function getAllContact_by_phone($credential,$phone)
	{
		$url = 'https://api.salesforceiq.com/v2/contacts?properties.phone="'.$phone.'"';
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		
	}

//Post Contact
	function testContactPost()
	  {
		Client::relateIQ(GlobalVar::KEY, GlobalVar::SECRET);
		$contact = new Contact([]);
		$contact->name("FIROZ T");
		$contact->email(["juan.torrez@relateiq.com","jtorrez@personal.com"]);
		$contact->phone(["(888) 555-6666","(888) 555-7777"]);
		$contact->address("456 Main St, USA");
		$contact->company("RelateIQ");
		$contact->title("Naab");
		$contact->twhan("@juantorrez");
		$contact->liurl("https://www.linkedin.com/in/cavocado");
		return $res = $contact->create();
	   
	  }
	  
//Get One Contact By Id
	  function getOneContact($credential, $id)
	  {
		  $url = 'https://api.salesforceiq.com/v2/contacts/'.$id;
		$curl = curl_init($url);
		$header = array('Accept:application/json');
		curl_setopt($curl, CURLOPT_USERPWD, $credential);
		curl_setopt($curl, CURLOPT_HEADER,http_build_query($header));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		return $json_response = curl_exec($curl);
		curl_close ($curl);
		 
	  }

$data = getAllContacts($credential);
$data = json_decode($data,true);
echo '<pre>';
print_r($data);
?>