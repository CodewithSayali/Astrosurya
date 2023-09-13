$(function () {
    var baseurl = "https://astrosurya.in/staging";
    // $.validator.addMethod("lettersWithSingleSpace", function (value, element) {
    //     return this.optional(element) || /^[a-zA-Z]+$|^[a-zA-Z]+ [a-zA-Z]+$/i.test(value);
    // }, "Letters and single space allowed");
    // $.validator.addMethod("custom_email",
    //         function (value, element) {
    //             return /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
    //         }, "The specified email address is not valid");
    // Mobile validation
    $.validator.addMethod("mobile", function (value) {
        if (/^[()0-9+\[\]]+$/i.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "The specified phone number is not valid");
    $.validator.addMethod("validate_email", function (value, element) {
        if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
            return true;
        } else {
            return false;
        }
    }, "Enter valid email address");
    $.validator.addMethod("email_or_mobile", function (value, element) {
        if (this.optional(element) || /*is optional*/
                /^\d{8,16}$/.test(value) || /*is mobile number*/
                /\S+@\S+\.\S+/.test(value))/*is email*/
        {
            return true;
        } else {
            return false;
        }
    }, "Enter valid mobile number or e-mail");
    $.validator.addMethod("alphabets_space", function (value, element) {
        if (this.optional(element) || /^[a-zA-Z\s]+$/.test(value))
        {
            return true;
        } else {
            return false;
        }
    }, "Enter only alphabets or space");
    $("#frmRegister").validate({

        rules: {
            txtFirstName: {
                required: true,
                alphabets_space: true,
                maxlength: 100
            },
            txtLastName: {
                required: true,
                alphabets_space: true,
                maxlength: 100
            },
            txtEmail: {
                required: true,
                validate_email: true,
                maxlength: 320,
                 remote: {
                     url: baseurl + "check-email",
                     type: "post",
                     data: {
                         txtEmail: function () {
                             return $("#txtEmail").val();
                         }
                     }
                 }

            },
            txtPhone: {
                required: true,
                minlength: 8,
                maxlength: 16,
                mobile: true,
                remote: {
                    url: baseurl + "check-mobile",
                    type: "post",
                    data: {
                        txtPhone: function () {
                            return $("#txtPhone").val();
                        }
                    }
                }
            },
            txtPassword: {
                required: true,
                minlength: 8,
                maxlength: 25,
            },
            txtConfirmPassword: {
                required: true,
                equalTo: "#txtPassword"
            },
            chkTerms: {
                required: true
            },
        },
        messages: {
            txtFirstName: {
                required: "Enter your first name",
                maxlength: "Upto 100 characters are allowed",
            },
            txtLastName: {
                required: "Enter your last name",
                maxlength: "Upto 100 characters are allowed",
            },
            txtEmail: {
                required: "Enter your email",
                maxlength: "Upto 320 characters are allowed",
                remote: "This email id already registered with us, please click on Login."
            },
            txtPhone: {
                required: "Enter your mobile number",
                minlength: "Minimum length should be 8",
                maxlength: "Maximum length should be 16",
                remote: 'This phone number already registered with us, please click on Login.',
            },
            txtPassword: {
                required: "Enter your password",
                minlength: "Minimum length should be 8",
                maxlength: "Maximum length should be 25",
            },
            txtConfirmPassword: {
                required: "Enter your password",
                equalTo: "Enter same password"
            },
            chkTerms: {
                required: "Agree privacy policy & terms of use",
            },
        },
        submitHandler: function (form) {
            //console.log("test1");
            //alert(baseurl+'create-account');
            $.ajax({
                url: baseurl + 'create-account',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    //$('#btnSubmit').prop('disabled', true);
                    console.log(response);
                    if (response.success == true) {
                       // alert("success");
                       $('#btnSubmit').prop('disabled', true);
                        toastr.success(response.msg, {timeOut: 5000});
                        window.location.href = baseurl + "home";
                    } else
                    {
                        //$("#valid-error").html(response.msg);
                        //$("#valid-error").css("display", "block");
                        //$('#btnSubmit').prop('disabled', false);
                    }
                },
                error: function (response) {
                    console.log(response);
                }

            });
        }
    });
    $("#frmUserLogin").validate({

        rules: {
            txtEmailMobile: {
                required: true,
                email_or_mobile: true,
                maxlength: 320,
            },
            txtPassword: {
                required: true,
            }
        },
        messages: {
            txtEmailMobile: {
                required: "Enter either mobile number or e-mail",
                maxlength: "Maxlength is 320 character"
            },
            txtPassword: {
                required: "Enter Password",
            }
        },
        submitHandler: function (form) {
            //alert(baseurl+'create-account');
            $.ajax({
                url: baseurl + 'check-login',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    //alert(response);
                    if (response.success == true) {
                        window.location.href = baseurl + "home";
                    } else
                    {
                        if (response.error_no == '3')
                        {
                            toastr.info("You aren't registered yet, please sign up.");
                        } else
                        {
                            toastr.error(response.msg);
                        }


                    }
                },
                error: function (response) {
                    console.log(response);
                }

            });
        }
    });
    $("#frmContact").validate({
        rules: {
            txtName: {
                required: true,
                lettersWithSingleSpace: true
            },
            txtEmail: {
                required: true,
                custom_email: true,
                maxlength: 320,
            },
//            selQuery: {
//                required: true
//            },
            txtMobile: {
                required: true,
                mobile: true,
                minlength: 8,
                maxlength: 16
            },
            txtMessage: {
                required: true,
            }
        },
        messages: {
            txtName: {
                required: "Enter your name",
                maxlength: "Upto 100 characters are allowed",
            },
            txtEmail: {
                required: "Enter your email",
                maxlength: "Upto 320 characters are allowed",
            },
//            selQuery: {
//                required: "Select your Query",
//            },
            txtMobile: {
                required: "Enter your contact number",
                minlength: "Minimum length should be 8",
                maxlength: "Maximum length should be 16",
            },
            txtMessage: {
                required: "Enter your message",
            }
        },
        submitHandler: function (form) {
            //alert(baseurl + 'edit-profile');
            $.ajax({
                url: baseurl + 'submit-contact',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    //console.log(response);
                    if (response.success == true) {
                        toastr.success('Thank you for contacting us', {timeOut: 5000});
                        $('#frmContact').trigger("reset");
                        //window.location.href = baseurl + "profile";
                    } else
                    {
                        toastr.error('Something went wrong', {timeOut: 5000});
                        $("#valid-error").html(response.msg);
                        $("#valid-error").css("display", "block");
                    }
                },
                error: function (response) {
                    console.log(response);
                }

            });
        }
    });
});