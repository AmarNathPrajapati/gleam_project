<?php
session_start();
if (!isset($_SESSION["is_admin"])) {
  header("location: ./login.php");
}
include("../../backend/config.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
   
    <?php require('./admin_components/header_links.php'); ?>
    <link rel="stylesheet" href="./css/new_document.css">
    <title>New Document</title>
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
                            <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                                <!-- Title -->
                                <h1 class="h2 mb-0 ls-tight mb-3">New Document</h1>
                            </div>
                            <!-- Actions -->
                            <div class="col-sm-6 col-12 text-sm-end">
                                <div class="mx-n1">

                                    <!-- <a href="./new_document.php" class="btn d-inline-flex btn-sm btn-primary mx-1">
                                        <span class=" pe-2">
                                            <i class="bi bi-plus"></i>
                                        </span>
                                        <span>Create</span>
                                    </a> -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </header>
            <!-- Main -->
            <main class="py-6 bg-surface-secondary">
                <div class="container-fluid">


                    <div class="card shadow border-0 mb-7 p-sm-5">
                        <!-- <div class="card-header">
                            <h5 class="mb-0">Documents</h5>
                        </div> -->

                        <div class="form-box px-sm-5 mb-5">
                            <form class="px-sm-5" action="../../backend/admin/new_document.php"
                            onsubmit="return showloader()" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="doc_name" class="form-label">Document Name</label>
                                    <input type="text" placeholder="Document Name" required class="form-control" id="name" name="doc_name"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">For Country</label>
                                    <!-- <input type="text" required class="form-control" id="country" name="country"> -->
                                    <br>
                                    <select name="country" id="country">
                                        <?php
                                        $stmt="SELECT id,country_name FROM `countries` WHERE deleted_at IS NULL";
                                        $sql=mysqli_prepare($conn, $stmt);
                            
                                        $result=mysqli_stmt_execute($sql);
                                            if ($result){
                                                $data= mysqli_stmt_get_result($sql);
                                                $sno=1;
                                                while ($row = mysqli_fetch_array($data)){
                                        
                                        ?>
                                        <option value="<?php echo $row['id']?>"><?php echo $row['country_name']?></option>
                                        <?php
                                                }
                                            }
                                        ?>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label">Add Tags</label>
                                    <input type="text" name="taginput1" id="tag-input1"  required >
                                    <p>Type your tag and hit enter to create</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="file">Document File</label>
                                    <input type="file"  accept=".pdf,.docs,.docx,.png,.jpg,.jpeg" required class="form-control" name="document" id="file">
                                    <p class="text-danger">Only .pdf,.docs,.docx,.png,.jpg,.jpeg type file formate.</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="file">Will Student Upload</label>
                                    <br>
                                    <select name="student" id="student">
                                        <option value="0">No</option>
                                        <option value="1" selected>Yes</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

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
        tagInput1.addData(['Visa'])

    </script>

<?php require('./admin_components/scripts.php');?>

</body>

</html>