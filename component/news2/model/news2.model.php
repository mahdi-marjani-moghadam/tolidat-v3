<?php
/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:24 AM
 */

include_once(ROOT_DIR . "/common/validators.php");

class news extends looeic
{
    protected $TABLE_NAME='news2';

}
class adminnews2Model extends looeic
{
    protected $TABLE_NAME='news2';
    protected $GUARDED = array(
        'status'
    );

    protected $rules = array(
        'title' => 'required|min_len,5|max_len,10',
        'brif_description' => 'required|max_len,100'
    );

    public function comment()
    {
        $componenetAdress = ROOT_DIR."component/invoice/admin/model/admin.invoice.model.php";
        return $this->hasMany('admininvoiceModel','company_id','company_id',$componenetAdress);
    }


    public function address()
    {
        $componenetAdress = ROOT_DIR."component/companyAddresses/model/companyAddresses.model.php";
        //return $this->hasOne('c_addresses','company_id',$componenetAdress);
        return $this->hasMany('c_addresses','company_id',$componenetAdress);

    }

   /* public function admin()
    {
        $this->GUARDED = array( );

    }*/
}









class article extends looeic
{
    protected $TABLE_NAME='article';
    protected $GUARDED = array(
        'status'
    );

    protected $rules = array(
        'title' => 'required|min_len,5|max_len,10',
        'brif_description' => 'required|max_len,100'
    );



    public function comment()
    {
        $componenetAdress = ROOT_DIR."component/invoice/admin/model/admin.invoice.model.php";
        return $this->hasMany('admininvoiceModel','company_id',$componenetAdress);
    }

    /* public function admin()
     {
         $this->GUARDED = array( );

     }*/

}





class province1 extends looeic
{


}

/*

$rules = array(
	'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
	'password'    => 'required|max_len,100|min_len,6',
	'email'       => 'required|valid_email',
	'gender'      => 'required|exact_len,1',
	'credit_card' => 'required|valid_cc',
	'comment' => 'basic_tags',

	'bio'		  => 'required'
);



                 'required' :

                 'valid_email':

                 'max_len':

                 'min_len':

                 'exact_len':

                 'alpha':

                 'alpha_numeric':

                 'alpha_dash':

                 'numeric':

                 'integer':

                 'boolean':

                 'float':

                 'valid_url':

                 'url_exists':

                 'valid_ip':

                 'valid_cc':

                 'valid_name':

                 'contains':

                 'contains_list':

                 'doesnt_contain_list':

                 'street_address':

                 'date':

                 'min_numeric':

                 'max_numeric':

                 'starts':

                 'extension':

                 'required_file':

                 'equalsfield':

                 'min_age':*/
