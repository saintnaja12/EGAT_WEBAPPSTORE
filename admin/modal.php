<!-- dataModal ---------------------------------------------------------------------------------------------->

<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title">Table Application Details</h4>
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


 <!-- image_detail_Modal-------------------------------------------------------------------------------------------------------------------------------------->

 <div class="modal fade modal" id="image_detail_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">Table Screenshot</h5>
                <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="image_id_app" style="text-align:left;">            
                
            </div>
        </div>
    </div>
</div>



<!-- Modal Add file app-------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade modal" id="file_data_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">Table File Application</h5>
                <button type="button" id="btn_close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="file_id_app" style="text-align:center;" >

            </div>

            
        </div>
    </div>
</div>

<!-- add_data_Modal -------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade modal" id="add_data_Modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel">New data application</h5>
                <button type="button" id="btn_close_2" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" id="insert_form" >

                <!-- Modal body -->
                <div class="modal-body" style="text-align: left;">
                    <input type="hidden" name="id_app" id="id_app" class="form-control">

                    <label class="ml-1">Application name</label>
                    <input type="text" name="name_app" id="name_app" class="form-control" placeholder="">
                    <span id="availability"></span> <br/>

                    <label class="ml-1">Detail</label>
                    <textarea type="text" name="detail" id="detail" required class="form-control" placeholder=""
                        rows="3"></textarea>

                    <div class="form-group">
                        <label class="ml-1">System</label>
                        <select class="form-control" name="system" id="system" placeholder="Please choose platform" >
                            <option>iOS,Android</option>
                            <option>iOS</option>
                            <option>Android</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="ml-1">Language</label>
                        <select class="form-control" name="language" id="language" placeholder="Please choose language">
                            <option>English (US),Thai</option>
                            <option>English (US)</option>
                            <option>Thai</option>
                        </select>
                    </div>

                    <label class="ml-1">Version</label>
                    <input type="text" name="version" id="version" required class="form-control" placeholder="">

                    <div class="form-group">
                        <label class="ml-1">Permissions</label>
                        <select class="form-control" name="set_permissions" id="set_permissions" placeholder="">
                            <option>For EGAT workers only</option>
                            <option>Public dissemination</option>
                        </select>
                    </div>

                    <label class="ml-1">Department</label>
                    <input type="text" name="department" id="department" required class="form-control" placeholder="">

                    <!-- upload img -->
                    <input type="hidden" id="imgPath" name="imgPath" required class="form-control" placeholder="">                            
                    <label class="ml-1">Image logo</label> <br/>
                    <input type="file" name="file" id="file" /> <br/>
                    <span>
                        <img id="uploaded_image" height="150" width="225" class="img-thumbnail" hidden/>
                    </span><br/>

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

