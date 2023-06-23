<?php
include_once(dirname(__FILE__). "/model/news2.model.php");
$n=new news();
$n->title=$_GET['no'];
$n->save();
die();

include_once ROOT_DIR."component/companyAddresses/model/companyAddresses.model.php";

include_once(ROOT_DIR."component/invoice/admin/model/admin.invoice.model.php");

echo '<pre/>';

db::beginTransaction();

$result=new adminNews2Model();
$result->title=45;
$result->st=rand(10,30);

$r  =   $result->save();

$result=adminNews2Model::find(1);
$result->title='chera 5';
$result->st=rand(10,30);
$result->save();

$result=new news();
$result->title=45;
$result->save();

db::commit();

die('j');
//$result->where('title','like','a');
//$a=$result->getList();
print_r_debug($result);
//$result=DB::('select * from news24 ');
//DB::table('h')->where('ggg')->deleteFrom();

//DB::table('h')->deleteFrom()->where()->build()


/*
$n=adminNews2Model::getAll()
    ->where('category_id', '=', '%100%')
    ->orWhere('category_id', 'like', '%100%');

$b=$n->getList();
print_r_debug($n);/


/*$object=c_addresses::find(53455);
print_r_debug($object->company->first()->fields);
*/


/*$object=adminnews2Model::find(4);
print_r_debug($object->address->getList());

print_r_debug($object->address->fields);
///$object->title='';
//print_r_debug($object);

$i=0;

foreach ($object['export']['list'] as $obj)
{
    $i++;
    echo '<pre/>'.$i.'<br/>';
    print_r($obj->address->fields);
}
die();*/


//$n=adminNews2Model::getAll()->orderBy('title','asc')->orderBy('brif_description','asc')->getList();
//print_r_debug($n);


//SELECT id, label, link, parent, sort FROM menus ORDER BY parent, sort, update_at DESC

//$n->maneger_name='malek';
//$n->save();
//print_r_debug($n);
//$n['export']['list']['0']->company_type='10';

//$n->save();
//print_r_debug($n);



   //$a= DB::table('company_d')
    $a= adminNews2Model::getAll()
        ->leftJoin('c_addresses_d', 'company_d.company_id', '=', 'c_addresses_d.company_id')
        ->select(
                'company_d.Company_d_id',
                'company_d.package_status',
                'company_d.new_register',
                'company_d.isAdmin',
                'c_addresses_d.subject',
                'company_d.admin_description')
        ->limit(1,10)
        ->paginate(15,$_get['page']);
        $n2= $a->getList();
//$n2->product_category='288888888888,2';
//$n2->state_id=$n2->state_id+1;
//$n2->save();
echo '<pre/>';
//$a=$n2['export']['list']['0'];
//$a->package_status=6;
//$a->save();
//print_r($a);

print_r_debug($n2);

//->leftJoin('c_news', '`company`.`Company_id`', '=', '`c_news`.`company_id`');
//            $n->where('username', 'like', 'admin%');
//            $n->orWhere('username', 'like', '%,a');
//            $n->orWhere('username', 'like', '%,a,%');

//$n->andWhere('(news2_id = 18 or news2_id = 18 ) ');
//$n->groupBy('title');
//$n->orderBy('News_id','asc');





$object=adminNews2Model::getAll()
    ->keyBy('title',0)
    ->getList();


print_r_debug($object);


/*$a = new DB();
$q = $a
    ->update('news')
    ->set(array('title' => 'Arthur', 'brif_description' => 'Borisow'))
    ->where('userId', '=', 1)
    ->orWhere('name', '=', 'Arthur')
    ->build();*/

print_r_debug($a);




////////////////////////////////////

$n=new DB();
$a= DB::table('c_news')
    ->select(
    '`c_news`.`News_id`',
  '`c_news`.`company_id`',
  '`c_news`.`title`',
  '`company`.`category_id`',
  '`company`.`company_name`')
  ->leftJoin('company', '`c_news`.`company_id`', '=', '`company`.`Company_id`')
   ->leftJoin('c_addresses', '`c_news`.`company_id`', '=', '`company`.`Company_id`')
   ->groupBy('`c_news`.`title`')
   ->orderBy('News_id','asc');

$b=$a->getList();
print_r_debug($a);








$arr=array('news2_id','title');
$n=adminnews2Model::getAll();
   $b=$n->getList();
print_r_debug($b['export']['list']['110000']);

foreach ($b['export']['list'] as $fields)
{
    if($fields['news2_id']== '101708')
    {
        die('find');
    }
}


/*for($i=1;$i<=100000;$i++)
{
    $n=new adminnews2Model();
    $n->title=$i.'test'.$i.'bye'.$i;
    $n->brif_description=$i.'salam'.$i.'bye';
    $n->description=$i++.'salam'.$i++.'bye'.$i++;

    $n->save();
}*/
die('j');

//print_r_debug($n);

//$n->title='yguygy';





/*$result=adminNews2Model::query('select * from news2 ');

print_r_debug($result->get());
print_r_debug($n->get());*/


 //   ->groupBy('title');
//$res=$n->getList();

/*$n= adminNews2Model::getAll()
    ->groupBy('title');
$res=$n->getList();
print_r_debug($res);*/



//////////////////////////////////////
//$n=new DB();
//$a= DB::table('c_news');
//    ->select(
//    '`c_news`.`News_id`',
//  '`c_news`.`company_id`',
//  '`c_news`.`title`',
//  '`company`.`category_id`',
//  '`company`.`company_name`')
  //  ->leftJoin('company', '`c_news`.`company_id`', '=', '`company`.`Company_id`')
 //   ->leftJoin('c_addresses', '`c_news`.`company_id`', '=', '`company`.`Company_id`')
 //   ->groupBy('`c_news`.`title`')
 //   ->orderBy('News_id','asc');

//$b=$a->getList();
//print_r_debug($a);

//$a->join('orders', 'users.id', '=', 'orders.user_id');
//$a->leftJoin('invoice', 'invoice.id', '=', 't.user_id');
////////////////////////////////////////


/*   ->where('news2_id', 'in',
    function ($n)
    {
        return $n->select('*')->from('category')->where('news2_id', '=', 8);
    }*/


///////////////////////////

//$n=new DB();
//$a=$n->select('min(news2_id)')
//    ->from('news2')
//    ->where('news2_id', 'in', array(1, 3, 4, 5))
//    ->get()['export']['list'];
//
//
//print_r_debug($n);
////////////////////////////////////////

/*$n=adminNews2Model::getAll();
$n->where('News_id', '=', 8);
$newobj=$n->first();

print_r($n);
die();*/


/*class company extends looeic {

}*/


/*$conn->beginTransaction();
$conn->rollBack();
$conn->commit();*/
//echo '<br/> start <br/>';
//$n= adminNews2Model::getBy_username('admin');
    //->leftJoin('c_news', '`company`.`Company_id`', '=', '`c_news`.`company_id`');
//            $n->where('username', 'like', 'admin%');
//            $n->orWhere('username', 'like', '%,a');
//            $n->orWhere('username', 'like', '%,a,%');

            //$n->andWhere('(news2_id = 18 or news2_id = 18 ) ');
            //$n->groupBy('title');
            //$n->orderBy('News_id','asc');




//$n->beginTransaction();
//$newobj=$n->first();
//print_r($newobj);
//$newobj->name='qqq';
//$newobj->save();

//print_r($newobj);
//$n= adminNews2Model::getBy_username('admin')->first();;
//$n->name='ccc';
//$n->save();

//print_r($n);





//$n->commit();

/*$n= adminNews2Model::getBy_username('admin')->first();
$n=adminNews2Model::find(10);
$n->name='wwwww';
$n->save();
//$n->delete();
$n->rollBack();


$b= article::find('22')->first();
$b->url='eeee';
$b->save();
print_r($b);*/


//$n->rollBack();
//$b->commit();

//print_r($n);
die();
print_r($n);
echo '<br/> end <br/>';

die();

//$newobj->company_name='a123456';
//$newobj->save();
//print_r_debug($newobj);

//die();
//echo $newobj->title;
//$newobj->save();

$newobj->description='aaaa';
$newobj->save();


print_r_debug($newobj);

//echo '<pre/>';
//print_r_debug($n);

/*$n=adminNews2Model::getBy_title('a')->get();
print_r($n);
die();*/
$searchFields['limit']['start']=0 ;
$searchFields['limit']['length']=10;

echo '<pre/>';
print_r($result->getList());
die();
$result = $n->getByFilter($searchFields,'select * from news')->limit(1,5)->get();
echo '<pre/>';
print_r($result);
die();
echo json_encode($result);


/*
$title=array('1','2');
$object=adminNews2Model::getBy_news2_id($title)->get();
print_r_debug($object);
*/



$_POST = array(
    'title' => 'yy',
    'meta_keyword' => 'uigiyhuihuihuih'

);

$n=new adminNews2Model();

$n->setFields($_POST,-1);
$n->save();
print_r_debug($n);

//$n->title='yguygy';


$n->title='';
$n->brif_description='jkghugh';
$n->setadmin();
print_r_debug($n->validator());

$n->save();














session_start();
$_SESSION['a']=1;
echo $_SESSION['a'];
/*
$p['a'][0]['time']=4;
$p['a'][0]['day']=1;

$p['b'][0]['time']=5;
$p['b'][0]['day']=2;


$p['a'][1]['time']=4;
$p['a'][1]['day']=4;

$p['b'][1]['time']=7;
$p['b'][1]['day']=5;

$count=count($p['a']);
for($i=0;$i<$count;$i++)
{
    $p['a'][$i]['sum']=100+$p['a'][$i]['time'];
    $p['a'][$i]['sum']=$p['a'][$i]['sum'].(100+$p['a'][$i]['day']);

    $p['b'][$i]['sum']=100+$p['b'][$i]['time'];
    $p['b'][$i]['sum']=$p['b'][$i]['sum'].(100+$p['b'][$i]['day']);
}
echo '<pre/>';
print_r($p);

for($i=0;$i<$count-1;$i++)
{
    if($p['a'][$i]['sum']<=$p['a'][$i+1]['sum'] and ($p['b'][$i]['sum']>=$p['a'][$i+1]['sum']))
    {

        //echo 'eee'.$p['a'][$i+1]['sum'];
        echo $p['a'][$i]['sum'].'<='.$p['a'][$i+1]['sum'] .' and ('.$p['b'][$i]['sum'].' >= '.$p['a'][$i+1]['sum'].')';
    }


}




print_r_debug();*/

//global $company_info;
//print_r_debug($company_info);

include_once(dirname(__FILE__). "/model/news2.model.php");
include_once(ROOT_DIR."component/invoice/admin/model/admin.invoice.model.php");

//$ids = array('1', '2', '3');
$object=adminnews2Model::find(1)->comment->first();
$object->title='';
print_r_debug($object);

foreach ($object['export']['list'] as $obj)
{
    echo '<pre/>';
    print_r($obj->comment);
}



print_r_debug();
$result=adminNews2Model::getAll()->orderBy('news2_id','asc')->getList();

print_r_debug($result);


/*$object=adminNews2Model::find(1);
$r=$object->validator();
print_r($r);
echo 'a';*/

/*$ids=array('1','2');
$p=admininvoiceModel::getBy_company_id($ids);
print_r_debug($p->get()['export']['list']['1']->news->getList());*/

//$p=admininvoiceModel::find(2);
//print_r_debug($p);
//die();


$ids=array('1','2');
$object=adminNews2Model::getBy_news2_id($ids)->limit(10)->get();
print_r_debug($object);
echo '<pre/>';


//print_r_debug($object['export']['list']);

foreach ($object['export']['list'] as $obj)
{
    print_r($obj->comment->getList());
}
//hasmany
//print_r_debug($object);
print_r_debug();

foreach ($object->comment as $obj)
{
    print_r($obj->comment->get());
}
//echo $object->brif_description;
//$object=new adminNews2Model();
//$object->title='';
//$object->date='callMysql(now())';
$object->brif_description='wertyu';
$object->save();
print_r_debug($object);
$object->getByFilter($fields,"select * from news where status='1' ");



$ids=array('1','2');
//$result=adminNews2Model::getBy_not_news2_id($ids)->orderBy('news2_id','DESC')->getList();

//$result=adminNews2Model::query("select * from news2 where news2_id<>'1' ")->getList();


///
$fields['title']="callMysql(title+'1')";
$where='news2_id > 5';
$result=adminNews2Model::update($fields,$where);
print_r_debug($result);
//////////////////
echo '<pre/>';
//print_r($result);

//hasmany
foreach ($result['export']['list'] as $obj)
{
    print_r($obj->comment->get());
}
echo '*********';
die();
//hasmany

//$obj=$result['export']['list']['0'];
//$obj->title='www';
print_r_debug($result);


//****validate
//$object->title='';
//$object->brif_description='';

//$r=$object->validator();
echo '<pre/>';
/*print_r($r);
if($r['result']==-1)
{
    $result['msg']=$r[msg];
    $result['result']=-1;
    return $result;
}
//****validate

echo '<pre/>';
//print_r($object);
print_r_debug($r);*/

//$object->save();


/*$object=new adminNews2Model();

$fields['filter']['News_id']='p';
$fields['where']='news_id=2 or  ';
$fields['limit']['start']='0';
$fields['limit']['length']='10';
$fields['order']['News_id']='DESC';
$result=$object->getByFilter($fields);
print_r_debug($result);*/

//$object=model::find('news',1);
//$object=model::find('news',1);

//$object->title= 'My first blog post!!!';
//$object->save();
//print_r_debug($object);

//echo '1';



//$object=adminNews2Model::getBy_title('b')->first();
$ids = array('1', '2', '3');
$object=adminnews2Model::getBy_news2_id($ids)->comment->getList();
print_r_debug($object);

$object=adminNews2Model::find(100);
print_r_debug($object);
die();

echo '2';
$object=adminNews2Model::find(1);

$post=$object->post->first();

print_r_debug($post);




$object=adminNews2Model::getBy_title('b')->first();

$r=$object->validator();
echo '<pre/>';
print_r_debug($r);
$object->title='aa';

$object->save();

$object=adminNews2Model::find(1);


//$object =   looeic::model('news2')->find(1);
$ids = array('1', '2', '3');

$object=looeic::model('news2')->getBy_News_id_or_title($ids,'a')->get();

//$object=adminNews2Model::find('1');
print_r_debug($object);



//marjani
$object=model::find('news2',2);

$object->title='4';
define ('formAdd_01','dorost vared kon');
$rules = array(
    'title' => '
    |min_len,5*'.formAdd_01.''
);

$r=$object->validator($rules)['msg'];


print_r_debug($r);
//marjani

//******* sample 1 **************************
/*$object=new adminNews2Model();
$object->date=" callMysql( now() ) ";
$object->brif_description='jkghugh';
$object->save();
print_r_debug($object->fields);*/


/*$object=adminNews2Model::find(60);
$object->date="callMysql(now())";
$object->brif_description='jkghugh';

$object->save();
print_r_debug($object->fields);*/


//*******end  sample 1 **********************




//******* sample 2 **************************
/*$_POST = array(
    'title' => 'yy',
    'brif_description' => 'yy'
);

$object=new adminNews2Model($_POST);

print_r_debug($object->validator()['msg']);

$object->save();
print_r_debug($object->fields);*/
//*******end  sample 2 **********************



//******* sample 3 **************************
$object=adminNews2Model::find('5');
$object->brif_description='hi';
$object->save();
print_r_debug($object->fields);

//*******end  sample 3 **********************




/*$object=adminNews2Model::table(news2);
$object->date="callMysql(now())";
$object->brif_description='jkghugh';*/


//******* sample 4 **************************

//$list=adminNews2Model::getBy_News_id(58)->getList();

$ids = array('1', '2', '3');
$list=adminNews2Model::getBy_News_id_or_title($ids,'b')->orderby('News_id','desc')->get();
print_r_debug($list);

$object->brif_description='hi';
$object->save();
print_r_debug($object);
//*******end  sample 4 ***********************


//******* sample 5 **************************
$object=adminNews2Model::getBy_News_id_or_title('113','jkghugh')
    ->orderBy('title')
    ->get();
$object->brif_description='hi';
$object->save();
print_r_debug($object);
//*******end  sample 5 ***********************



















/*
Class A{
    protected $fields_list;

    public function __construct($fields='')
    {
        echo '<pre/>';
        //if(method_exists($this, 'child_method')){
        echo $this->fields_list;


        $this->fields_list ='b';
        echo $this->fields_list;

    }
    function call_child_method(){
        echo '<pre/>';
        //if(method_exists($this, 'child_method')){
        print_r($this);

        $this->fields_list ='b';
            $this->child_method();
        print_r($this);

        //}
    }
}


Class B extends A{
    protected $fields_list ='a';

    protected function child_method(){
        echo $this->fields_list;
    }
}
$test = new B();
$test->call_child_method();
print_r_debug($test);
*/


/**
 * Created by PhpStorm.
 * User: malek
 * Date: 2/20/2016
 * Time: 4:21 AM
 */

include_once(dirname(__FILE__). "/model/news2.model.php");
global $admin_info,$PARAM;



$_POST = array(
'title' => 'hjhhhjkh',
 'brif_description' => 'jkghugh'
    );
$n=new adminNews2Model();

$n->title='ali';
$n->brif_description='jkghugh';
$n->save();

print_r_debug($n);


print_r_debug($n);



$n=new adminNews2Model();
$n->setFields($_POST);
print_r_debug($n);

$n->title='';
$n->brif_description='jkghugh';
$n->setadmin();
print_r_debug($n->validator());

$n->save();




print_r_debug($n->validator()['msg']);



print_r_debug($n);


$n->setadmin();

print_r_debug($n->validator());
//print_r_debug($n->getErr());
die();
$n->save();





//$class=adminNews2Model::getBy_title('rr');
//$result=adminNews2Model::getBy_News_id_or_title('113','jkghugh');


//$new=adminNews2Model::find(106);



//$result=adminNews2Model::getBy_News_id('106','a');
//print_r_debug($new);















die();
$fields['limit']['start']='0';
$fields['limit']['length']='2';
$fields['order']['News_id']='ASC';
$fields['filter']['News_id']='107';
$fields['where']=' News_id= 100 or News_id=106 ';
print_r_debug($fields);
$result=$n->getByFilter($fields);

print_r_debug($result);

if($result['result']==1)
{
    print_r_debug($result);
}
//$newsController = new news2Controller();

//$newsController->test();

?>
