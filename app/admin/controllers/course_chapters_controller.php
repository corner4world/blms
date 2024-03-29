<?php

/*****************************************************************************
 * Seevia 章节管理
 * ===========================================================================
 * 版权所有  上海实玮网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.seevia.cn
 * ---------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ===========================================================================
 * $开发: 上海实玮$
 * $Id$
 *****************************************************************************/
/**
 *这是一个名为 CourseChaptersController 的控制器
 *章节管理控制器.
 *
 *@var
 *@var
 *@var
 *@var
 */
App::import('Controller', 'Commons');
class CourseChaptersController extends AppController
{
    public $name = 'CourseChapters';
    public $components = array('Pagination', 'RequestHandler', 'Phpexcel', 'Phpcsv');
    public $helpers = array('Pagination', 'Html', 'Form', 'Javascript', 'Time', 'Ckeditor');
    public $uses = array('CourseChapter','CourseClass','InformationResource','CourseClassWare','CourseLearningPlan');

    /**
     *添加章节
     */
    public function add($code)
    {
        $this->menu_path = array('root' => '/hr/','sub' => '/courses/');
        $this->set('title_for_layout', $this->ld['add'].'-课程管理- '.$this->configs['shop_name']);
        $this->navigations[] = array('name' => "在线学习",'url' => '');
        $this->navigations[] = array('name' => "课程管理",'url' => '/courses/');
        $this->navigations[] = array('name' => $this->ld['add']."章节",'url' => '');
        if ($this->RequestHandler->isPost()) {
            $this->data["CourseChapter"]["course_code"]=$code;
            $this->CourseChapter->save($this->data);
            $back_url = $this->operation_return_url();//获取操作返回页面地址
            $this->redirect($back_url);
        }
        $this->set('code', $code);
    }

    /**
     *编辑章节
     */
    public function view($id)
    {
        $this->operation_return_url(true);
        $this->menu_path = array('root' => '/hr/','sub' => '/courses/');
        $this->set('title_for_layout', $this->ld['edit'].'-课程管理- '.$this->configs['shop_name']);
        $this->navigations[] = array('name' => "在线学习",'url' => '');
        $this->navigations[] = array('name' => "课程管理",'url' => '/courses/');
        $this->navigations[] = array('name' => $this->ld['edit']."章节",'url' => '');
        $course_chapter_info=$this->CourseChapter->find('first',array('conditions'=>array('CourseChapter.id'=>$id)));
        $course_class_info=$this->CourseClass->find('all',array('conditions'=>array('CourseClass.chapter_code'=>$course_chapter_info["CourseChapter"]["code"])));
        if ($this->RequestHandler->isPost()) {
            $this->CourseChapter->save($this->data);
            $back_url = $this->operation_return_url();//获取操作返回页面地址
            $this->redirect($back_url);
        }
        $resource_info=$this->InformationResource->information_formated('courseware_type',$this->backend_locale,false);
        $this->set('resource_info',$resource_info);
        $this->set('course_chapter_info', $course_chapter_info);
        $this->set('course_class_info', $course_class_info);
    }

    /**
     * 删除章节
     *
     *@param int $id
     */
    public function remove($id)
    {
        Configure::write('debug', 1);
        $this->layout = 'ajax';
        $result['flag'] = 2;
        $result['message'] = $this->ld['delete_member_failure'];
        $course_chapter_info = $this->CourseChapter->findById($id);
        $this->CourseChapter->deleteAll(array('CourseChapter.id' => $id));
        $course_class_ids=$this->CourseClass->find('list',array('fields'=>'id','conditions'=>array('CourseClass.chapter_code'=>$course_chapter_info["CourseChapter"]["code"])));
        if(!empty($course_class_ids)){
        	$this->CourseLearningPlan->deleteAll(array('CourseLearningPlan.course_class_id' => $course_class_ids));
        	$this->CourseClassWare->deleteAll(array('CourseClassWare.chapter_code' => $course_chapter_info["CourseChapter"]["code"]));
        	$this->CourseClass->deleteAll(array('CourseClass.chapter_code' => $course_chapter_info["CourseChapter"]["code"]));
        }
        //操作员日志
        if (isset($this->configs['operactions-log']) && $this->configs['operactions-log'] == 1) {
            $this->OperatorLog->log(date('H:i:s').' '.$this->ld['operator'].' '.$this->admin['name'].' '.$this->ld['log_delete_user'].':id '.$id.' '.$course_chapter_info['CourseChapter']['code'], $this->admin['id']);
        }
        $result['flag'] = 1;
        $result['message'] = $this->ld['delete_member_success'];
        if ($this->RequestHandler->isPost()) {
            die(json_encode($result));
        } else {
            $this->redirect('/courses/');
        }
    }
    
    function ajax_modify(){
        Configure::write('debug', 1);
        $this->layout = 'ajax';
        $result=array();
        $result['code']='0';
        $result['message']=$this->ld['modify_failed'];
        $this->CourseChapter->save($this->data);
        $result['code']='1';
        $result['message']='操作成功';
        die(json_encode($result));
    }
    
	function ajax_edit($id){
        Configure::write('debug', 1);
        $this->layout = 'ajax';
        $result=array();
        $result['code']='0';
        $result['message']=$this->ld['modify_failed'];
        $course_chapter_info=$this->CourseChapter->find('first',array('conditions'=>array('CourseChapter.id'=>$id)));
        $result['code']='1';
        $result['data']=$course_chapter_info;
        die(json_encode($result));
    }
    
	/**
     * 检查code
     *
     */
    public function check_code()
    {
    	Configure::write('debug', 1);
        $result['code'] = 0;
        $result['msg'] = '';
        if ($this->RequestHandler->isPost()) {
            $code = isset($_POST['code']) ? $_POST['code'] : '';
            $chapter_count = $this->CourseChapter->find('count', array('conditions' => array('CourseChapter.code' => $code, 'CourseChapter.status' => "1")));
            if ($chapter_count == 0) {
                $result['code'] = 1;
            } else {
                $result['msg'] = "code已存在";
            }
            die(json_encode($result));
        } else {
            $this->redirect('/courses');
        }
    }
}