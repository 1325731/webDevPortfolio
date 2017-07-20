{$Header}
<div class="body-content">
    <div class="chatbox">
        <h3>{$WelChat}</h3>
        <div class="chatmessages">
        <button id="connect" onclick="connect()">{$Connect}</button>
        <div hidden class="messagebox">
            <list class="messagelist">
                {$ChatStuff}
            </list>
        </div>
        <div hidden class="chatinput">
            <input type="text" name="msgfromusr" id="msgfromusr"/>
            <button id="sendmsg" onclick="store()">{$Enter}</button>
        </div>
        </div>
    </div>
    <br />
    <span id="msg"></span>
</div>
<footer><p>&copy; 2016 KyWill Gaming Company - All rights reserved - John Abbott, Ste Anne, Quebec H9X 3L9</p></footer>
</body>
</html>