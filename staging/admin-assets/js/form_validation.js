$(function () {
    var baseurl = "https://astrosurya.in/staging";
    $('[rel="tooltip"]').tooltip({
        trigger: 'hover'
    });

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
//    $.validator.addMethod("minAge", function (value, element, min) {
//        var today = new Date();
//        var birthDate = new Date(value);
//        var age = today.getFullYear() - birthDate.getFullYear();
//
//        if (age > min + 1) {
//            return true;
//        }
//
//        var m = today.getMonth() - birthDate.getMonth();
//
//        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//            age--;
//        }
//
//        return age >= min;
//    }, "You are not old enough!");
    $("#frmAdminLogin").validate({

        rules: {
            txtEmail: {
                required: true,
                validate_email: true,
                maxlength: 255,
            },
            txtPassword: {
                required: true,
            },
            txtPin: {
                required: true,
            }

        },
        messages: {
            txtEmail: {
                required: "Please enter e-mail",
                validate_email: "Please Enter Valid Email Address",
                maxlength: "Maxlength is 255 character"
            },
            txtPassword: {
                required: "Please enter your password",
            },
            txtPin: {
                required: "Please enter pin",
            }
        },
        submitHandler: function (form) {
            //alert(baseurl+'create-account');
            $.ajax({
                url: baseurl + 'admin/check-admin-login',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {

                    if (response.success == true) {
                        toastr.success("Login Successfull");
                        window.location.href = baseurl + "admin/dashboard";
                    } else
                    {
                        toastr.error("Email, password or pin not correct.");
                    }
                },
                error: function (response) {
                    toastr.error("Email, password or pin not correct.");
                }

            });
        }
    });


    $("#frmEditUser").validate({
        rules: {
            user_id: {
                required: true,
            },
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
                // remote: {
                //     url: baseurl + "check-email",
                //     type: "post",
                //     data: {
                //         txtEmail: function () {
                //             return $("#txtEmail").val();
                //         }
                //     }

                // }

            },
            txtPhone: {
                required: true,
                minlength: 8,
                maxlength: 16,
                mobile: true
                        // remote: {
                        //     url: baseurl + "check-mobile",
                        //     type: "post",
                        //     data: {
                        //         txtPhone: function () {
                        //             return $("#txtPhone").val();
                        //         }
                        //     }
                        // }
            },
            txtDob: {
                required: true
            },
            txtLatitude: {
                required: true
            },
            txtLongitude: {
                required: true
            },
            txtTimezone: {
                required: true
            },
            radGender: {
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
                //remote: "This email id already registered with us, please click on Login."
            },
            txtPhone: {
                required: "Enter your mobile number",
                minlength: "Minimum length should be 8",
                maxlength: "Maximum length should be 16",
                //remote: 'This phone number already registered with us, please click on Login.',
            },
            txtDob: {
                required: "Enter your Date of birth",
            },
            txtLatitude: {
                required: "Enter your latitude",
            },
            txtLongitude: {
                required: "Enter your longitude",
            },
            txtTimezone: {
                required: "Enter your timezone",
            },
            radGender: {
                required: "select your gender",
            },
        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-user',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("User updated successfully");
                        window.location.reload();

                    } else {
                        toastr.error("Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmUserDelete").validate({
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/delete-user',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("User deleted successfully");
                        window.location.reload();

                    } else {
                        toastr.error("Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }

            });
        }
    });

    $("#frmEditPage").validate({
        rules: {
            pg_id: {
                required: true,
            },
            title: {
                required: true,
                maxlength: 200,
            },
            content: {
                required: true,
            },
            seo_keywords: {
                required: true,
            },
            image: {
                required: true,
                extension: "jpg|png"
            }

        },
        messages: {
            title: {
                required: "Please enter page title",
                maxlength: "Please enter text upto 200 characters",
            },
            content: {
                required: "Please enter page content",
            },
            seo_keywords: {
                required: "Please enter seo keywords",
            },
            image: {
                required: "Please upload image.",
                extension: "Please upload image in these format only (jpg, png)."
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-page',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response == 1) {
                        toastr.success("Page updated successfully");
                        window.location.href = baseurl + "admin/manage-pages";
                    } else {
                        toastr.error("Page Unsuccessfully");
                    }
                },
                error: function (response) {
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmEditMail").validate({
        rules: {
            id: {
                required: true,
            },
            subject: {
                required: true,
                maxlength: 200,
            },
            content: {
                required: true,
                maxlength: 1000,
            }

        },
        messages: {
            subject: {
                required: "Please enter Subject",
                maxlength: "Please enter text upto 200 characters"
            },
            content: {
                required: "Please enter content",
                maxlength: "Please enter text upto 1000 characters",
            },

        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-mail',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response == 1) {
                        toastr.success("Mail Template updated successfully");
                        window.location.href = baseurl + "admin/mail-templates";
                    } else {
                        toastr.error("Mail Templates Unsuccessfully");
                    }
                },
                error: function (response) {
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmService").validate({
        rules: {
            service_id: {
                required: true,
            },
            name: {
                required: true,
                alphabets_space: true,
                maxlength: 100
            },
            description: {
                required: true,
//                maxlength: 2000,
            },
            price: {
                required: true,
            },
            gst: {
                required: true,
            },
            service_charge: {
                required: true,
            },
            tax: {
                required: true,
            },

        },
        messages: {
            name: {
                required: "Please enter Name",
                maxlength: "Please enter text upto 200 characters"
            },
            description: {
                required: "Please enter Description",
//                maxlength: "Please enter text upto 2000 characters",
            },
            price: {
                required: "Please enter Price",

            },
            gst: {
                required: "Please enter gst",

            },
            service_charge: {
                required: "Please enter service charge",

            },
            tax: {
                required: "Please enter Tax",

            },
        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-service',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("Service updated successfully");
                        window.location.href = baseurl + "admin/manage-services";

                    } else {
                        toastr.error("Service Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmServiceDelete").validate({
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/delete-service',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("Service deleted successfully");
                        window.location.reload();

                    } else {
                        toastr.error("Service Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }

            });
        }
    });

    $("#frmSeo").validate({
        rules: {
            id: {
                required: true,
            },
            title: {
                required: true,
//                alphabets_space: true,
                maxlength: 100
            },
            description: {
                required: true,
//                maxlength: 2000,
            },
            keywords: {
                required: true,
            },

            canonical: {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Enter your Title",

            },
            description: {
                required: "Enter your Description",
//                maxlength: "Upto 100 characters are allowed",
            },
            keywords: {
                required: "Enter your Keywords",
//                minlength: "Minimum length should be 8",
//                maxlength: "Maximum length should be 16",
                //remote: 'This phone number already registered with us, please click on Login.',
            },
            canonical: {
                required: "Enter your URL",
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-seo',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("SEO updated successfully");
                        window.location.href = baseurl + "admin/manage-seo";

                    } else {
                        toastr.error("Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmTeam").validate({
        rules: {
            team_id: {
                required: true,
            },
            fullname: {
                required: true,
                maxlength: 200,
            },
            designation: {
                required: true,
            },
            content: {
                required: true,
                maxlength: 1000,
            }

        },
        messages: {
            fullname: {
                required: "Please enter full name",
                maxlength: "Please enter text upto 200 characters",
            },
            designation: {
                required: "Please enter designation",
            },
            content: {
                required: "Please enter content",
                maxlength: "Please enter text upto 1000 characters",
            }

        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-team',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    if (response == 1) {
                        toastr.success("Team updated successfully");
                        window.location.href = baseurl + "admin/manage-teams";
                    } else {
                        toastr.error("Team Unsuccessfully");
                    }
                },
                error: function (response) {
                    toastr.error("Something went wrong");
                }
            });
        }
    });

    $("#frmLogoUpload").validate({
        rules: {
            settingId: {
                required: true,
            },
            settingName: {
                required: true,
                maxlength: 100
            }
        },
        messages: {
            settingName: {
                required: "Enter your first name",
                maxlength: "Upto 100 characters are allowed",
            }
        },
        submitHandler: function (form) {
            $.ajax({
                url: baseurl + 'admin/update-setting',
                type: 'POST',
                data: new FormData(form),
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response == 1) {
                        toastr.success("Setting updated successfully");
                        window.location.reload();

                    } else {
                        toastr.error("Unsuccessfully");
                    }
                },
                error: function (response) {
                    console.log(response);
                    toastr.error("Something went wrong");
                }
            });
        }
    });

});
