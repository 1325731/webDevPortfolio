<?php
/* Smarty version 3.1.30, created on 2016-11-13 18:00:05
  from "/home/ubuntu/workspace/WPAs5/View/Template/user_create.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5828aa251960b0_09846166',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f78d525ee3bb1ba038c7270e739d1f3aff1b9d7' => 
    array (
      0 => '/home/ubuntu/workspace/WPAs5/View/Template/user_create.tpl',
      1 => 1479059961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5828aa251960b0_09846166 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['Header']->value;?>

<div class="body-content">
    <div class="myform">
        <br />
        <span><?php echo $_smarty_tpl->tpl_vars['EnUser']->value;?>
:</span>
        <input type="text" id="user" name="user"></input>
        <br /><br />
        <span><?php echo $_smarty_tpl->tpl_vars['EnPass']->value;?>
:</span>
        <input type="password" id="pass" name="pass"></input>
        <br /><br />
        <span><?php echo $_smarty_tpl->tpl_vars['EnMail']->value;?>
:</span>
        <input type="tet" id="mail" name="mail"></input>
        <br /><br />
        <button id="create" onclick="create()"><?php echo $_smarty_tpl->tpl_vars['CUser']->value;?>
</button>
    </div>
    <span id="msg"></span>
</div>
<footer><p>&copy; 2016 KyWill Gaming Company - All rights reserved - John Abbott, Ste Anne, Quebec H9X 3L9</p></footer>
</body>
</html>
<?php }
}
