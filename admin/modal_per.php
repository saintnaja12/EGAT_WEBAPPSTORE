    <!-- Modal Select Detail ---------------------------------------------------------------------------------------------->

    <div id="dataModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">

                        <h4 class="modal-title">User Details</h4>
                        <button type="button" align="right" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="app_detail">
                                
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal Add -------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="modal fade modal" id="add_data_Modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                    <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="appModalLabel">User</h5>
                    <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <form method="POST" id="insert_form" >

                    <!-- Modal body -->
                    <div class="modal-body" >
                        <input type="hidden" name="id_user" id="id_user" class="form-control">

                        <label class="ml-1">Username</label>
                        <input type="text" name="username" id="username" required class="form-control" placeholder="">
                        <span id="availability"></span> <br/>
                        
                        <label class="ml-1">Password</label>
                        <input type="text" name="password" id="password" required class="form-control" placeholder="">

                        <label class="ml-1">First name</label>
                        <input type="text" name="fname" id="fname" required class="form-control" placeholder="">

                        <label class="ml-1">Last name</label>
                        <input type="text" name="lname" id="lname" required class="form-control" placeholder="">

                        <label class="ml-1">E-mail</label>
                        <input type="text" name="e_mail" id="e_mail" required class="form-control" placeholder="" >
                        <span id="availability_2"></span> <br/>

                        <div class="form-group">
                            <label class="ml-1">Group</label>
                            <select class="form-control" name="row" id="row" placeholder="Please choose platform">

                                <option>Employee</option>
                                <option>Developer</option>
                                <option>Admin</option>
                            </select>
                        </div>   

                        <br />
                    </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <input type="button" name="insert" id="insert" class="btn btn-primary" value="Insert">

                </div>
                </form>
            </div>
        </div>
    </div>


   <!-- Modal per -------------------------------------------------------------------------------------------------------------------------------------------->

    <div class="modal fade modal" id="perModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                    <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="appModalLabel">Set Permissions</h5>
                    <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    
                <form method="POST" id="per_form" >

                <?php

                $Developer = 'Developer';

                $query = "SELECT * FROM user_s WHERE row ='$Developer'";

                $result = sqlsrv_query($conn, $query);

                if($row = sqlsrv_fetch_array($result))
                {
                    
                ?>

                    <!-- Modal body -->
                    <div class="modal-body" >
                        <input type="hidden" name="Developer" id="Developer" class="form-control">

                        <label class="ml-1">Application Table</label><br>
                        
                        <!-- Adding -->
                        <div class="form-check form-check-inline"> 
                            <?php 
                            if($row['adding_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="adding_toggle" id="adding_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_adding_toggle" id="hidden_adding_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>

                            <?php
                            }else{
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="adding_toggle" id="adding_toggle" data-size="sm" />
                                </div>
                                <input type="hidden" name="hidden_adding_toggle" id="hidden_adding_toggle" value="off" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- Edit -->
                        <div class="form-check form-check-inline">
                            <?php 
                            if($row['edit_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="edit_toggle" id="edit_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_edit_toggle" id="hidden_edit_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Edit</label>

                            <?php
                            }else{
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="edit_toggle" id="edit_toggle" data-size="sm"/>
                                </div>
                                <input type="hidden" name="hidden_edit_toggle" id="hidden_edit_toggle" value="off" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Edit</label>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- Delete -->
                        <div class="form-check form-check-inline">
                            <?php 
                            if($row['del_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="del_toggle" id="del_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_del_toggle" id="hidden_del_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>

                            <?php
                            }else{
                            ?>

                            <div class="checkbox">
                                <input type="checkbox" name="del_toggle" id="del_toggle" data-size="sm"/>
                            </div>
                            <input type="hidden" name="hidden_del_toggle" id="hidden_del_toggle" value="off" />
                            <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>
                            <?php
                            }
                            ?>
                        </div>

                        <br><br>

                        <label class="ml-1">Screenshots Table</label><br>

                        <!-- Adding Image -->
                        <div class="form-check form-check-inline">
                        <?php 
                            if($row['adding_image_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="adding_image_toggle" id="adding_image_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_adding_image_toggle" id="hidden_adding_image_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>

                            <?php
                            }else{
                            ?>

                            <div class="checkbox">
                                <input type="checkbox" name="adding_image_toggle" id="adding_image_toggle" data-size="sm"/>
                            </div>
                            <input type="hidden" name="hidden_adding_image_toggle" id="hidden_adding_image_toggle" value="off" />
                            <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- Delete Image -->
                        <div class="form-check form-check-inline">
                        <?php 
                            if($row['del_image_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="del_image_toggle" id="del_image_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_del_image_toggle" id="hidden_del_image_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>

                            <?php
                            }else{
                            ?>

                            <div class="checkbox">
                                <input type="checkbox" name="del_image_toggle" id="del_image_toggle" data-size="sm"/>
                            </div>
                            <input type="hidden" name="hidden_del_image_toggle" id="hidden_del_image_toggle" value="off" />
                            <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>
                            <?php
                            }
                            ?>
                        </div>

                        <br><br>

                        <label class="ml-1">Files Table</label><br>

                        <!-- Adding Files -->
                        <div class="form-check form-check-inline">
                        <?php 
                            if($row['adding_file_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="adding_file_toggle" id="adding_file_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_adding_file_toggle" id="hidden_adding_file_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>

                            <?php
                            }else{
                            ?>

                            <div class="checkbox">
                                <input type="checkbox" name="adding_file_toggle" id="adding_file_toggle" data-size="sm"/>
                            </div>
                            <input type="hidden" name="hidden_adding_file_toggle" id="hidden_adding_file_toggle" value="off" />
                            <label class="form-check-label ml-1" for="inlineCheckbox1">Add</label>
                            <?php
                            }
                            ?>
                        </div>

                        <!-- Delete Files -->
                        <div class="form-check form-check-inline">
                        <?php 
                            if($row['del_file_toggle'] == 'on')
                            {
                            ?>

                                <div class="checkbox">
                                    <input type="checkbox" name="del_file_toggle" id="del_file_toggle" data-size="sm" checked/>
                                </div>
                                <input type="hidden" name="hidden_del_file_toggle" id="hidden_del_file_toggle" value="on" />
                                <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>

                            <?php
                            }else{
                            ?>

                            <div class="checkbox">
                                <input type="checkbox" name="del_file_toggle" id="del_file_toggle" data-size="sm"/>
                            </div>
                            <input type="hidden" name="hidden_del_file_toggle" id="hidden_del_file_toggle" value="off" />
                            <label class="form-check-label ml-1" for="inlineCheckbox1">Delete</label>
                            <?php
                            }
                            ?>
                        </div>

                    </div>

                    <?php
                    }
                    ?>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <input type="submit" name="insert_per" id="insert_per" class="btn btn-primary" value="Insert">

                </div>
                </form>
            </div>
        </div>
    </div>