<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

    <div data-role="collapsible" data-theme="b" data-content-theme="d" data-collapsed="false">
        <h3>Login Form</h3>
        <span id="login_error"></span>
        <p>
        <?php
            echo form_open('','name="f_login"');
        ?>
            <ul data-role="listview">
                
                <li data-role="fieldcontain">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" />
                </li>
                <li data-role="fieldcontain">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value=""  />
                </li>
                <li data-role="fieldcontain">
                    <label for="captcha"><?php echo  $cap['image'] ?></label>
                    <input type="text" name="captcha" id="captcha" value=""  />
                </li>
                
            </ul>
            <a class='mybutton' data-theme="b" href="javascript:void(0)" onclick="login()" data-role="button" >Login</a> 
        </form>
        </p>

    </div>