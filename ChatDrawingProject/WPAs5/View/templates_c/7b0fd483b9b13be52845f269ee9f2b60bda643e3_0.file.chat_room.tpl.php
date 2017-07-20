<?php
/* Smarty version 3.1.30, created on 2016-11-21 13:24:09
  from "/home/ubuntu/workspace/WPAs5/View/Template/chat_room.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5832f57963db63_16816991',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7b0fd483b9b13be52845f269ee9f2b60bda643e3' => 
    array (
      0 => '/home/ubuntu/workspace/WPAs5/View/Template/chat_room.tpl',
      1 => 1479734648,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5832f57963db63_16816991 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['Header']->value;?>

<div class="body-content">
    <div class="chatbox">
        <h3><?php echo $_smarty_tpl->tpl_vars['WelChat']->value;?>
</h3>
        <div class="chatmessages">
        <button id="connect" onclick="connect()"><?php echo $_smarty_tpl->tpl_vars['Connect']->value;?>
</button>
        <div hidden class="messagebox">
            <list class="messagelist">
                <?php echo $_smarty_tpl->tpl_vars['ChatStuff']->value;?>

            </list>
        </div>
        <div hidden class="chatinput">
            <input type="text" name="msgfromusr" id="msgfromusr"/>
            <button id="sendmsg" onclick="store()"><?php echo $_smarty_tpl->tpl_vars['Enter']->value;?>
</button>
        </div>
        </div>
    </div>
    <br />
    <span id="msg"></span>
</div>
<footer><p>&copy; 2016 KyWill Gaming Company - All rights reserved - John Abbott, Ste Anne, Quebec H9X 3L9</p></footer>
</body>
</html><?php }
}
