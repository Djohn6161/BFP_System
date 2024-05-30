<style>
    .btn-reports {
        width: 200px
    }
</style>
@extends('layouts.user-template')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11 p-4">
                <form method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="row border border-light-subtle shadow rounded p-4 mb-4 bg-white">
                            <h3 class="border-bottom border-4 border-secondary pb-2 mb-3">My Password</h3>
                            <div class="col-lg-12">
                                <div class="col-lg-12 mb-3">
                                    <label for="update_password_current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control"  name="current_password" id="update_password_current_password">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="update_password_password" class="form-label">New password</label>
                                    <input type="password" class="form-control"  name="password_id" id="update_password_password">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirmation" id="update_password_password_confirmation">
                                </div>
                                
                                <div class="col d-flex justify-content-end mb-2 py-3">  
                                    <a href="{{route('user.dashboard')}}" type="button" class="btn btn-secondary me-2">Cancel</a>
                                    <button id="saveChangesBtn" class="btn btn-primary">Update </button>
                                </div>
                                
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <script>
        $(document).ready(function() {
            $("#editTertiaryCourse").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter tertiary course/s" class="form-control" id="tertiaryCourses"> <button type="button" class="btn btn-outline-danger removeTertiaryInputEdit">x</button> </div> </div>';
                $("#editTertiaryCourseContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removeTertiaryInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });

            $("#editPostGraduateCourses").click(function() {
                var inputField =
                    '<div class="col-lg-12 px-0 mb-3"> <div class="input-group"> <input type="text" placeholder="Enter post graduate course/s" class="form-control" id="postGraduateCourses"> <button type="button" class="btn btn-outline-danger removePostGraduateInputEdit">x</button> </div> </div>';
                $("#editPostGraduateCoursesContainer").append(inputField);
            });

            // Remove dynamically added input field
            $(document).on('click', '.removePostGraduateInputEdit', function() {
                $(this).closest('.col-lg-12').remove();
            });
        });

        // Function to preview photo using jQuery
        function previewPhoto(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#personnel-picture').attr('src', e.target.result).attr('alt', 'Selected Image');
            }

            reader.readAsDataURL(file);
        }

        // Function to save data and redirect using jQuery
        function saveDataAndRedirect() {
            // Perform saving data here (e.g., AJAX request)
            // After data is successfully saved, redirect to another page
            window.location.href = "";
        }

        // Attach click event listener to the button
        document.getElementById("saveChangesBtn").addEventListener("click", function() {
            saveDataAndRedirect();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const tinInput = document.getElementById('tin');
            const pagibigInput = document.getElementById('pagibig');
            const gsisInput = document.getElementById('gsis');
            const philhealthInput = document.getElementById('philhealth');

            const restrictToNumbers = function(inputElement) {
                inputElement.addEventListener('input', function(event) {
                    const inputValue = event.target.value;
                    const cleanedValue = inputValue.replace(/[^0-9\-]/g,
                        ''); // Remove any characters that are not numbers or hyphens
                    event.target.value = cleanedValue;
                });
            };

            restrictToNumbers(tinInput);
            restrictToNumbers(pagibigInput);
            restrictToNumbers(gsisInput);
            restrictToNumbers(philhealthInput);

            const formatGovernmentID = function(inputElement, format) {
                inputElement.addEventListener('input', function(event) {
                    const inputValue = event.target.value;
                    const cleanedValue = inputValue.replace(/[^0-9]/g,
                        ''); // Remove any characters that are not numbers
                    let formattedValue = '';
                    if (format === 'TIN') {
                        formattedValue = cleanedValue.replace(/(\d{3})(\d{3})(\d{3})/, '$1-$2-$3');
                    } else if (format === 'PAGIBIG') {
                        formattedValue = cleanedValue.replace(/(\d{4})(\d{4})(\d{4})/, '$1-$2-$3');
                    } else if (format === 'GSIS') {
                        formattedValue = cleanedValue.replace(/(\d{2})(\d{2})(\d{7})/, '$1-$2-$3');
                    } else if (format === 'PHILHEALTH') {
                        formattedValue = cleanedValue.replace(/(\d{2})(\d{9})(\d{1})/, '$1-$2-$3');
                    }
                    event.target.value = formattedValue;
                });
            };

            formatGovernmentID(tinInput, 'TIN');
            formatGovernmentID(pagibigInput, 'PAGIBIG');
            formatGovernmentID(gsisInput, 'GSIS');
            formatGovernmentID(philhealthInput, 'PHILHEALTH');
        });

        //personnel file upload
        $(document).ready(function() {
            $('#file-input').change(handleFileSelect);
        });

        function handleFileSelect(event) {
            var fileList = $('#file-list');
            fileList.html('');

            var files = event.target.files;

            // Update file count
            var fileCountSpan = $('#file-count');
            fileCountSpan.text(files.length + ' file(s)');

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var listItem = $(
                    '<div class="file-item d-flex justify-content-between mb-2 align-items-center"></div>');

                var fileName = $('<span></span>').text(file.name);
                listItem.append(fileName);

                var deleteButton = $('<button class="btn btn-danger">Delete</button>');
                deleteButton.on('click', createDeleteHandler(file, fileCountSpan));
                listItem.append(deleteButton);

                fileList.append(listItem);
            }
        }

        function createDeleteHandler(file, fileCountSpan) {
            return function() {
                var fileList = $('#file-list');
                var fileItems = fileList.find('.file-item');
                for (var i = 0; i < fileItems.length; i++) {
                    if ($(fileItems[i]).find('span').text() === file.name) {
                        $(fileItems[i]).remove();
                        break;
                    }
                }

                // Update file count after deletion
                var remainingFiles = fileList.find('.file-item').length;
                fileCountSpan.text(remainingFiles + ' file(s)');
            };
        }
    </script>
@endsection
