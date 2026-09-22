<?php

defined('BASEPATH') or exit('No direct script access allowed');

require('AppDefault.php');

class Cron_controller extends AppDefault {

    public function __construct() {
        parent::__construct();
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }

    public function getFreeCredit() {

        die('ok');
        $result = $this->db->query("SELECT DISTINCT tbl_user.email, tbl_user.*  FROM `tbl_user` INNER JOIN tbl_package_transaction ON tbl_package_transaction.email = tbl_user.email WHERE tbl_user.status = 'active' AND tbl_package_transaction.transaction_from = 'jvz' AND tbl_package_transaction.transaction_type = 'SALE' AND tbl_user.id=1 ")->result_array();

        foreach ($result as $key => $val) {
            $creditVal = $val['credit'] + 350000;
            $this->db->where('email', $val['email']);
            $this->db->update('tbl_user', ['credit' => $creditVal]);
        }
        echo "done";
        die;
    }

    public function chatbotCron() {

        $this->db->where('assistant_status', 'custom');
        $this->db->where('cron_status =', '');
        $this->db->order_by('id', 'ASC')->limit(10);
        $data = $this->db->get('prompts')->result_array();
        if (!empty($data)) {
            foreach ($data as $key => $val) {
                $ownerDirectoryName = 'assets/uploads/users/' . $val['business_id'];
                $library_folder = 'pdf_docs';
                $dirname = $ownerDirectoryName . '/' . $library_folder . '/';
                $textdirname = $ownerDirectoryName . '/' . 'text_files/';
                $pineCredential = $this->pineconeCrediential($val['business_id']);
                $pineCredential = json_decode($pineCredential->credentials);
                $array_value = json_decode($val['pdf_docs'], true);
                $urls = json_decode($val['urls'], true);

                // $array_value = array(
                //     'https://www.africau.edu/images/default/sample.pdf',
                //     'https://www.indiabudget.gov.in/doc/budget_speech.pdf'
                // );

                $comma_value = implode(',', $array_value);
                $comma_urls = implode(',', $urls);
                // set POST variables
                $url = 'http://ai.dotcompaluat.com/process';
                $path = 'aitubestar/' . $val['business_id'];
                $fields = array(
                    'urls' => $comma_urls,
                    'path' => $path,
                    'pdf_docs' => $comma_value,
                    'pinecone_api_key' => $pineCredential->pinecone_api_key,
                    'pinecone_env' => $pineCredential->pinecone_environment,
                    'pinecone_index' => $pineCredential->pinecone_index_name,
                );

                //url-ify the data for the POST
                $fields_string = http_build_query($fields);

                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                //execute post
                $result = curl_exec($ch);
                sleep(3);

                if ($result) {

                    $decodedResponse = json_decode($result, true);
                    $txt = $decodedResponse['chat_history'];
                    echo $result;
                    if ($txt == 'Successfully Train') {
                        $this->db->where('id', $val['id']);
                        $this->db->update('prompts', ['cron_status' => 'complete']);
                    } else {
                        $this->db->where('id', $val['id']);
                        $this->db->update('prompts', ['cron_status' => 'failed']);
                    }
                    array_map('unlink', glob("$dirname/*.*"));
                    rmdir($dirname);
                    array_map('unlink', glob("$textdirname/*.*"));
                    rmdir($textdirname);

                    //close connection
                }
                curl_close($ch);
            }
        }
        //die('ok');
    }

}
