<?php

/*****************************************************************************
 * svoms  联系我们配置模型
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
class ContactConfig extends AppModel
{
    /*
     * @var $useDbConfig 数据库配置
     */
    public $useDbConfig = 'cms';
    /*
     * @var $name UserConfig 用户配置
     */
    public $name = 'ContactConfig';

    /*
     * @var $hasOne array 关联分类多语言表
     */
    public $hasOne = array('ContactConfigI18n' => array('className' => 'ContactConfigI18n',
            'conditions' => array('locale' => LOCALE),
            'order' => 'ContactConfig.orderby asc',
            'dependent' => true,
            'foreignKey' => 'contact_config_id',
        ),
    );
}