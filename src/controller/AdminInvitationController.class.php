<?php
lmb_require('limb/cms/src/controller/lmbAdminObjectController.class.php');
lmb_require('src/model/Invitation.class.php');

class AdminInvitationController extends lmbAdminObjectController
{
  protected $_object_class_name = 'Invitation';
}