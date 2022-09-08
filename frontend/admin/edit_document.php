<?php 
    include("../../backend/config.php");
    session_start();
    if (!isset($_SESSION["is_admin"])) {
        header("location: ./login.php");
    }
    else{
        $stmt="SELECT countries.country_name,documents.* 
        FROM documents INNER JOIN countries ON countries.id=documents.country WHERE documents.id=(?) AND documents.deleted_at IS NULL LIMIT 1";
        $sql=mysqli_prepare($conn, $stmt);

        //binding the parameters to prepard statement

        $is_admin=1;
        
        mysqli_stmt_bind_param($sql,"i",$_GET["doc_id"]);
        $result=mysqli_stmt_execute($sql);

        if ($result){
            $data= mysqli_stmt_get_result($sql);
           
            if ($data->num_rows>0) {
                # code...
               $row=mysqli_fetch_array($data);
               mysqli_stmt_close($sql);
               $stmt="SELECT * FROM countries WHERE deleted_at IS NULL";
               $sql=mysqli_prepare($conn, $stmt);
       
               //binding the parameters to prepard statement
       
            //    $is_admin=1; 
               
            //    mysqli_stmt_bind_param($sql,"i",$_GET["doc_id"]); 
               $result=mysqli_stmt_execute($sql);
               $data= mysqli_stmt_get_result($sql);
       
               if (!$result){
                  
                 echo '<script>
                 alert("Sorry something went wrong.");
                 window.location.href = "./dashboard.php";
             </script>';
                   
               }
            }
            
        }
        else{

?>
<script>
    alert("Sorry something went wrong.");
    window.location.href = "./dashboard.php";
</script>
<?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('./admin_components/header_links.php'); ?>
    
    <title>Edit Document</title>

    <style>
        body {
            /* font: 12px/1.5 'PT Sans', serif; */
            /* margin: 25px; */
        }



        .showtag {
            background: #eee;
            border-radius: 3px 0 0 3px;
            color: #999;
            display: inline-block;
            height: 26px;
            line-height: 26px;
            padding: 0 20px 0 23px;
            position: relative;
            margin: 0 10px 10px 0;
            text-decoration: none;
            -webkit-transition: color 0.2s;

            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style {
            max-width: 99% !important;
            overflow-x: auto;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .overflow_style::-webkit-scrollbar {
            display: none;
        }

        .showtag::before {
            background: #fff;
            border-radius: 10px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
            content: '';
            height: 6px;
            left: 10px;
            position: absolute;
            width: 6px;
            top: 10px;
        }

        .showtag::after {
            background: #fff;
            border-bottom: 13px solid transparent;
            border-left: 10px solid #eee;
            border-top: 13px solid transparent;
            content: '';
            position: absolute;
            right: 0;
            top: 0;
        }

        .showtag:hover {
            background-color: blue;
            color: white;
        }

        .showtag:hover::after {
            border-left-color: blue;
        }

        .tags-input-wrapper {
            background: transparent;
            padding: 10px;
            border-radius: 4px;
            /* max-width: 400px; */
            border: 1px solid #ccc
        }

        .tags-input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            width: 140px;
            margin-left: 8px;
        }

        .tags-input-wrapper .tag {
            display: inline-block;
            background-color: #5C60F5;
            color: white;
            border-radius: 10px;
            padding: 2px 4px 0px 10px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div id="loader" class="center"></div>
    <!-- Dashboard -->
    <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
        <!-- Vertical Navbar -->
        <?php require('./admin_components/side_bar.php'); ?>


        <!-- Main content -->
        <div class="h-screen flex-grow-1 overflow-y-lg-auto">
            <!-- Header -->
            <header class="bg-surface-primary border-bottom pt-6">
                <div class="container-fluid">
                    <div class="mb-npx">
                        <div class="row align-items-center">
                            <div class="col-sm-6 col-8 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-3">Profile</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-4 text-sm-end">
                                <div class="mx-n1">
                                </div>
                            </div>
                        </div>
                        <!-- Nav -->
                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">
                    <!-- Card stats -->


                    <div class="card shadow border-0 mb-7">
                        <div class="card-header">
                            <div class="container-fluid p-sm-5 my-5" style="font-size: 22px;">
                                <form action="../../backend/admin/edit_document.php" 
                                method="post" onsubmit="return showloader()" enctype="multipart/form-data">
                                    <div class="row mb-4 d-none">
                                        
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Document Id:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly name="doc_id" value=" <?php echo $row["id"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Document Name:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" readonly  required id="doc_name" name="doc_name" 
                                            style="width: 100%;" 
                                              value="<?php echo $row["name"];?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Country:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" id="showcountry" name="showcountry" 
                                            readonly value="<?php echo $row["country_name"];?>">
                                            <select name="country" id="country" hidden>
                                                <?php
                                                  if ($data->num_rows>0) {
                                                    # code...
                                                   while( $country_row=mysqli_fetch_array($data)){
                                                   ?>
                                                   <option <?php echo $row["country"]==$country_row['id']?"selected":"";?> value="<?php echo $country_row['id']; ?>"><?php echo $country_row['country_name']; ?></option>
                                                   <?php
                                                    
                                                    }
                                                }  
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Tags:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <div class="overflow_style" style="font-size: 18px;" id="show_tags_div">

                                                <?php
                                                    if($row["tags"]==null){
                                                        echo "Not Available";
                                                    }
                                                    else{
                                                        $tags=explode(",",$row["tags"]);
                                                        foreach($tags as $tag){
                                                            ?>
                                                            <a class="showtag">
                                                                <?php echo $tag==null?"Not Available":$tag; ?>
                                                            </a>
                                                        <?php
                                                                }
                                                            }
                                                        
                                                        ?>
                                            </div>

                                                <div id="tag_input" hidden>
                                                    <input type="text" name="taginput1" id="tag-input1" >
                                                </div>

                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            File:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <input type="text" hidden name="old_doc_file" value="<?php echo $row['file_location'];?>">
                                           <div id="show_doc">
                                            <?php 
                                            if($row['file_location']==null){
                                                echo "Not Available";
                                            }
                                            else{
                                                ?>
                                                <a href="<?php echo '../../documents/'.$row['file_location'];?>"><?php echo $row['name']; ?></a>
                                                <?php
                                            }
                                            ?>
                                           </div>
                                           <div id="take_doc" hidden>
                                            <input type="file"  accept=".pdf,.docs,.docx,.png,.jpg,.jpeg"  class="form-control" 
                                            name="document" id="file">
                                            <p class="text-danger">Only .pdf,.docs,.docx,.png,.jpg,.jpeg type file formate.</p>
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-auto text-center" style="font-size: 16px;">
                                            Will Student Upload:
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <div id="will_student">
                                                <?php echo $row['will_student']==1?"Yes":"No";?>
                                            </div>
                                           
                                            <select name="will_student_input" id="will_student_input" hidden>
                                                <!-- <option >No</option> -->
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                            


                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <button class="btn btn-neutral col-auto" onclick="make_editable()" type="button"
                                            id="editbtn">Edit</button>
                                        <button class="btn btn-neutral col-auto" type="submit" id="updatebtn"
                                            style="margin-right: 10px;" hidden>Update</button>
                                        <button class="btn btn-neutral col-auto" onclick="make_uneditable()"
                                            type="button" id="cancelbtn" hidden>Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function make_editable() {
            document.getElementById('editbtn').setAttribute('hidden', 'hidden');
            document.getElementById('updatebtn').removeAttribute('hidden');
            document.getElementById('cancelbtn').removeAttribute('hidden');

            document.getElementById('doc_name').removeAttribute('readonly');
            document.getElementById('doc_name').style.width="fit-content";
            document.getElementById('show_tags_div').setAttribute('hidden', 'hidden');
            document.getElementById('tag_input').removeAttribute('hidden');

            document.getElementById('show_doc').setAttribute('hidden', 'hidden');
            document.getElementById('take_doc').removeAttribute('hidden');

            document.getElementById('will_student').setAttribute('hidden', 'hidden');
            document.getElementById('will_student_input').removeAttribute('hidden');

            document.getElementById('showcountry').setAttribute('hidden', 'hidden');
            document.getElementById('country').removeAttribute('hidden');
        }
        function make_uneditable() {
            window.location.reload();
            // document.getElementById('updatebtn').setAttribute('hidden', 'hidden');
            // document.getElementById('cancelbtn').setAttribute('hidden', 'hidden');
            // document.getElementById('editbtn').removeAttribute('hidden');
            // // document.getElementById('cancelbtn').removeAttribute('hidden');

            // document.getElementById('tag_input').setAttribute('hidden', 'hidden');
            // document.getElementById('show_tags_div').removeAttribute('hidden');

            // document.getElementById('take_doc').setAttribute('hidden', 'hidden');
            // document.getElementById('show_doc').removeAttribute('hidden');

            // document.getElementById('will_student_input').setAttribute('hidden', 'hidden');
            // document.getElementById('will_student').removeAttribute('hidden');
            
            // document.getElementById('country').setAttribute('hidden', 'hidden');
            // document.getElementById('showcountry').removeAttribute('hidden');
        }
    </script>
    <script>
        function editbutton() {
            document.getElementById('editButton').style.display = "none";
            document.getElementById('updateButton').style.display = 'block';
            var x = document.getElementsByClassName("disabledClass");
            for (var i = 0; i < x.length; i++) {
                x[i].disabled = false;
            }
            var y = document.getElementsByClassName("hiddenClass");
            for (var i = 0; i < y.length; i++) {
                y[i].style.display = "none";
            }
            var z = document.getElementsByClassName("visibleClass");
            for (var i = 0; i < z.length; i++) {
                z[i].style.display = 'block';
            }

        }// end of function
    </script>

    <script>
        (function () {

            "use strict"


            // Plugin Constructor
            var TagsInput = function (opts) {
                this.options = Object.assign(TagsInput.defaults, opts);
                this.init();
            }

            // Initialize the plugin
            TagsInput.prototype.init = function (opts) {
                this.options = opts ? Object.assign(this.options, opts) : this.options;

                if (this.initialized)
                    this.destroy();

                if (!(this.orignal_input = document.getElementById(this.options.selector))) {
                    console.error("tags-input couldn't find an element with the specified ID");
                    return this;
                }

                this.arr = [];
                this.wrapper = document.createElement('div');
                this.input = document.createElement('input');
                init(this);
                initEvents(this);

                this.initialized = true;
                return this;
            }

            // Add Tags
            TagsInput.prototype.addTag = function (string) {

                if (this.anyErrors(string))
                    return;

                this.arr.push(string);
                var tagInput = this;

                var tag = document.createElement('span');
                tag.className = this.options.tagClass;
                tag.innerText = string;

                var closeIcon = document.createElement('a');
                closeIcon.innerHTML = '&times;';

                // delete the tag when icon is clicked
                closeIcon.addEventListener('click', function (e) {
                    e.preventDefault();
                    var tag = this.parentNode;

                    for (var i = 0; i < tagInput.wrapper.childNodes.length; i++) {
                        if (tagInput.wrapper.childNodes[i] == tag)
                            tagInput.deleteTag(tag, i);
                    }
                })


                tag.appendChild(closeIcon);
                this.wrapper.insertBefore(tag, this.input);
                this.orignal_input.value = this.arr.join(',');

                return this;
            }

            // Delete Tags
            TagsInput.prototype.deleteTag = function (tag, i) {
                tag.remove();
                this.arr.splice(i, 1);
                this.orignal_input.value = this.arr.join(',');
                return this;
            }

            // Make sure input string have no error with the plugin
            TagsInput.prototype.anyErrors = function (string) {
                if (this.options.max != null && this.arr.length >= this.options.max) {
                    console.log('max tags limit reached');
                    return true;
                }

                if (!this.options.duplicate && this.arr.indexOf(string) != -1) {
                    console.log('duplicate found " ' + string + ' " ')
                    return true;
                }

                return false;
            }

            // Add tags programmatically 
            TagsInput.prototype.addData = function (array) {
                var plugin = this;

                array.forEach(function (string) {
                    plugin.addTag(string);
                })
                return this;
            }

            // Get the Input String
            TagsInput.prototype.getInputString = function () {
                return this.arr.join(',');
            }


            // destroy the plugin
            TagsInput.prototype.destroy = function () {
                this.orignal_input.removeAttribute('hidden');

                delete this.orignal_input;
                var self = this;

                Object.keys(this).forEach(function (key) {
                    if (self[key] instanceof HTMLElement)
                        self[key].remove();

                    if (key != 'options')
                        delete self[key];
                });

                this.initialized = false;
            }

            // Private function to initialize the tag input plugin
            function init(tags) {
                tags.wrapper.append(tags.input);
                tags.wrapper.classList.add(tags.options.wrapperClass);
                tags.orignal_input.setAttribute('hidden', 'true');
                tags.orignal_input.parentNode.insertBefore(tags.wrapper, tags.orignal_input);
            }

            // initialize the Events
            function initEvents(tags) {
                tags.wrapper.addEventListener('click', function () {
                    tags.input.focus();
                });


                tags.input.addEventListener('keydown', function (e) {
                    var str = tags.input.value.trim();

                    if (!!(~[9, 13, 188].indexOf(e.keyCode))) {
                        e.preventDefault();
                        tags.input.value = "";
                        if (str != "")
                            tags.addTag(str);
                    }

                });
            }


            // Set All the Default Values
            TagsInput.defaults = {
                selector: '',
                wrapperClass: 'tags-input-wrapper',
                tagClass: 'tag',
                max: null,
                duplicate: false
            }

            window.TagsInput = TagsInput;

        })();

        var tagInput1 = new TagsInput({
            selector: 'tag-input1',
            duplicate: false,
            max: 10
        });
        // tagInput1.addData(['Visa'])

    </script>
 <?php require('./admin_components/scripts.php');?>

</body>

</html>