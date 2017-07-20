<?php
/* Smarty version 3.1.30, created on 2016-11-13 22:41:40
  from "/home/ubuntu/workspace/WPAs5/View/Template/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5828ec2439ab13_39211523',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd1f6b27d6bf2a81076f689bf889d9606c2f3ec7b' => 
    array (
      0 => '/home/ubuntu/workspace/WPAs5/View/Template/login.tpl',
      1 => 1479073424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5828ec2439ab13_39211523 (Smarty_Internal_Template $_smarty_tpl) {
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
        <button id="login" onclick="login()"><?php echo $_smarty_tpl->tpl_vars['Login']->value;?>
</button>
    </div>
    <span id="msg"></span>
</div>

<footer><p>&copy; 2016 KyWill Gaming Company - All rights reserved - John Abbott, Ste Anne, Quebec H9X 3L9</p></footer>
</body>
</html>
<?php }
}
