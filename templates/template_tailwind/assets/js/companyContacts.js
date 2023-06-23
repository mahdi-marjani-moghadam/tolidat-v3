$(document).ready(function() {
    var $body = $('body'),
        modal_add_address = $('#myModal1'),
        modal_edit_address = $('#myModal6'),
        branch,
        deleteAction = {
            deleteItemAddress: function(dataID) {
                $.post('/member/companyAddresses/delete/', {id: dataID}, function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.izi-container');
                    }
                    if (response.result == 1) {
                        var address_d_id = response.fields.Addresses_d_id;
                        var i = 0;
                        $(".remove-address").each(function () {
                            i++;
                            if ($(this).data('value') == address_d_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-address').append(html);
                        }
                    }
                });
            },
            deleteItemEmail: function(dataID) {
                $.post('/member/companyEmails/delete/', {id: dataID}, function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        var email_d_id = response.fields.Emails_d_id;
                        var i = 0;
                        $(".remove-email").each(function () {
                            i++;
                            if ($(this).data('value') == email_d_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-email').append(html);
                        }
                    }
                });
            },
            deleteItemSocial: function(dataID) {
                $.post('/member/companySocials/delete/', {id: dataID}, function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        var social_d_id = response.fields.Socials_d_id;
                        var i = 0;
                        $(".remove-social").each(function () {
                            i++;
                            if ($(this).data('value') == social_d_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-social').append(html);
                        }
                    }
                });
            },
            deleteItemWebsite: function(dataID) {
                $.post('/member/companyWebsites/delete/', {id: dataID}, function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == 1) {
                        var website_d_id = response.fields.Websites_d_id;
                        var i = 0;
                        $(".remove-website").each(function () {
                            i++;
                            if ($(this).data('value') == website_d_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-website').append(html);
                        }
                    }
                });
            },
            deleteItemPhone: function(dataID) {
                $.post('/member/companyPhones/delete/', {id: dataID}, function (data) {
                    var response = $.parseJSON(data);
                    if (response.result == -1) {
                        $.iziToastError(response.msg, '.izi-container');
                    }
                    if (response.result == 1) {
                        var phone_d_id = response.fields.Phones_d_id;
                        var i = 0;
                        $(".remove-phone").each(function () {
                            i++;
                            if ($(this).data('value') == phone_d_id) {
                                $(this).remove();
                                $.iziToastSuccess(response.msg, '.izi-container');
                            }
                        });
                        if (i == 1) {
                            var html = '<div class="notRecord">' +
                                '<img class="empty-img center-block" src="' + image + '">' +
                                '<p class="empty-text">اطلاعاتی موجود نیست!</p>';
                            $('.add-phone').append(html);
                        }
                    }
                });
            }
        };

    ////////////    Address jQuery   /////////////

    $('.addModalAddress').on('click', function () {
        branch = $(this).parents('div.tab-pane');
        modal_add_address.modal({show: true, backdrop: 'static'});
    });

    $("#addAddress").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[0];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyAddresses/add/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);

                if (response.fields.result == -1) {
                   $.iziToastError(response.fields.msg, '.iziAddAddress-container');
                   return;
                } else {
                    var address_d_id = response.fields.Addresses_d_id,
                        subject = response.fields.subject,
                        address = response.fields.address,
                        html = '<div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-address" data-value="' + address_d_id + '">' +
                            '<div class="container-input disable transition" data-toggle="tooltip" data-placement="bottom" title="">' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit editAddress" data-value="' + address_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash deleteAddress" data-value="' + address_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<span class="span-title">' + subject + '</span>' +
                            '<span class="span-report">' + address + '</span>' +
                            '<span class="submit-msg">تایید نشده</span>' +
                            '</div>' +
                            '</div>';
                    branch.find('.add-address').append(html);
                    branch.find('.address .notRecord').remove();
                    $('#addAddress').find('input, textarea').each(function () {
                        $(this).val("");
                    });
                    modal_add_address.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $("#editAddress").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[5];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyAddresses/edit/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziEditAddress-container');
                    return;
                } else {
                    var address_d_id = response.fields.Addresses_d_id;
                    var address_d_id_old = response.fields.Addresses_d_id_old;
                    var address_d_id_oldest = response.fields.Addresses_d_id_oldest;
                    var subject = response.fields.subject;
                    var address = response.fields.address;

                    branch.find(".remove-address").each(function () {
                        if ($(this).data('value') == address_d_id_old || $(this).data('value') == address_d_id_oldest) {
                            $(this).data('value', address_d_id);
                            $(this).find('.deleteAddress').data('value', address_d_id);
                            $(this).find('.editAddress').data('value', address_d_id);
                            $(this).find('div.container-input').addClass('disable');
                            $(this).find('div.container-input').attr('data-original-title', 'تایید نشده');
                            $(this).find('.span-title').text(subject);
                            $(this).find('.span-report').text(address);
                        }
                    });
                    modal_edit_address.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $body.on('click', '.editAddress', function (e) {
        e.preventDefault();
        branch = $(this).parents('div.tab-pane');
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemAddress(dataID, $this);
    });

    function editItemAddress(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });

        $.post('/member/companyAddresses/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit_address.find('[name="' + key + '"]').val(value);
            });

            $body.find('input[type="text"], input[type="email"], input[type="name"], input[type="phone"], input[type="password"], textarea').each(function () {
                if ($(this).val().length != 0) {
                    $(this).parent().addClass('typing');
                }
            });

            modal_edit_address.modal({show: true, backdrop: 'static'});
        });
    }

    $body.on('click', '.deleteAddress', function (e) {
        e.preventDefault();
        var dataID = $(this).data('value'),
            isLast = $body.find('.remove-address').length;

        $.removeIziToast('deleteItemAddress', dataID, isLast);
    });

    ////////////    Email jQuery   /////////////

    var modal_add_email = $('#myModal2');
    var modal_edit_email = $('#myModal7');

    $('.addModalEmail').on('click', function () {
        branch = $(this).parents('div.tab-pane');
        modal_add_email.modal({show: true, backdrop: 'static'});
    });

    $("#addEmail").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[1];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyEmails/add/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziAddEmail-container');
                    return;
                } else {
                    var email_d_id = response.fields.Emails_d_id,
                        subject = response.fields.subject,
                        email = response.fields.email,
                        html = '<div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-email" data-value="' + email_d_id + '">' +
                            '<div class="container-input disable transition" data-toggle="tooltip" data-placement="bottom" title="">' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit editEmail" data-value="' + email_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash deleteEmail" data-value="' + email_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<span class="span-title">' + subject + '</span>' +
                            '<span class="span-report">' + email + '</span>' +
                            '<span class="submit-msg">تایید نشده</span>' +
                            '</div>' +
                            '</div>';
                    branch.find('.add-email').append(html);
                    branch.find('.email .notRecord').remove();
                    $('#addEmail').find('input, textarea').each(function () {
                        $(this).val("");
                    });
                    modal_add_email.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $("#editEmail").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[6];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyEmails/edit/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziEditEmail-container');
                    return;
                } else {
                    var email_d_id = response.fields.Emails_d_id,
                        email_d_id_old = response.fields.Emails_d_id_old,
                        email_d_id_oldest = response.fields.Emails_d_id_oldest,
                        subject = response.fields.subject,
                        email = response.fields.email;

                    $(".remove-email").each(function () {
                        if ($(this).data('value') == email_d_id_old || $(this).data('value') == email_d_id_oldest) {
                            $(this).data('value', email_d_id);
                            $(this).find('.deleteEmail').data('value', email_d_id);
                            $(this).find('.editEmail').data('value', email_d_id);
                            $(this).find('div.container-input').addClass('disable');
                            $(this).find('div.container-input').attr('data-original-title', 'تایید نشده');
                            $(this).find('.span-title').text(subject);
                            $(this).find('.span-report').text(email);
                        }
                    });
                    modal_edit_email.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $body.on('click', '.editEmail', function (e) {
        e.preventDefault();
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemEmail(dataID, $this);
    });

    function editItemEmail(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $.post('/member/companyEmails/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit_email.find('[name="' + key + '"]').val(value);
            });

            $body.find('input[type="text"], input[type="email"], input[type="name"], input[type="phone"], input[type="password"], textarea').each(function () {
                if ($(this).val().length != 0) {
                    $(this).parent().addClass('typing');
                }
            });

            modal_edit_email.modal({show: true, backdrop: 'static'});
        });
    }

    $body.on('click', '.deleteEmail', function (e) {
        e.preventDefault();
        var dataID = $(this).data('value'),
            isLast = $body.find('.remove-email').length;

        $.removeIziToast('deleteItemEmail', dataID, isLast);
    });

    //////////      Social jQuery     /////////////////

    var modal_add_social = $('#myModal4');
    var modal_edit_social = $('#myModal9');

    $('.addModalSocial').on('click', function () {
        branch = $(this).parents('div.tab-pane');
        modal_add_social.modal({show: true, backdrop: 'static'});
    });

    $("#addSocial").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[3];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companySocials/add/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziAddSocial-container');
                    return;
                } else {
                    var social_d_id = response.fields.Socials_d_id,
                        social_type = response.fields.social_type_id,
                        url = response.fields.url,
                        html = '<div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-social" data-value="' + social_d_id + '">' +
                            '<div class="container-input disable transition" data-toggle="tooltip" data-placement="bottom" title="">' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit editSocial" data-value="' + social_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash deleteSocial" data-value="' + social_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<span class="span-title">' + social_type + '</span>' +
                            '<span class="span-report">' + url + '</span>' +
                            '<span class="submit-msg">تایید نشده</span>' +
                            '</div>' +
                            '</div>';
                    branch.find('.add-social').append(html);
                    branch.find('.social .notRecord').remove();
                    $('#addSocial').find('input, textarea').each(function () {
                        $(this).val("");
                    });
                    $('#addSocial').find('select').each(function () {
                        $("option:selected").prop("selected", false)
                    });
                    modal_add_social.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $("#editSocial").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[8];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companySocials/edit/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziEditSocial-container');
                    return;
                } else {
                    var social_d_id = response.fields.Socials_d_id,
                        social_d_id_old = response.fields.Socials_d_id_old,
                        social_d_id_oldest = response.fields.Socials_d_id_oldest,
                        social_type_id = response.fields.social_type_id,
                        url = response.fields.url;
                    $(".remove-social").each(function () {
                        if ($(this).data('value') == social_d_id_old || $(this).data('value') == social_d_id_oldest) {
                            $(this).data('value', social_d_id);
                            $(this).find('.deleteSocial').data('value', social_d_id);
                            $(this).find('.editSocial').data('value', social_d_id);
                            $(this).find('div.container-input').addClass('disable');
                            $(this).find('div.container-input').attr('data-original-title', 'تایید نشده');
                            $(this).find('.span-title').text(social_type_id);
                            $(this).find('.span-report').text(url);
                        }
                    });
                    modal_edit_social.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $('.editSocial').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemSocial(dataID, $this);
    });

    $body.on('click', '.editSocial', function (e) {
        e.preventDefault();
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemSocial(dataID, $this);
    });

    function editItemSocial(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $.post('/member/companySocials/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit_social.find('[name="' + key + '"]').val(value);
            });

            $body.find('input[type="text"], input[type="email"], input[type="name"], input[type="phone"], input[type="password"], textarea').each(function () {
                if ($(this).val().length != 0) {
                    $(this).parent().addClass('typing');
                }
            });

            modal_edit_social.modal({show: true, backdrop: 'static'});
        });
    }

    $body.on('click', '.deleteSocial', function (e) {
        e.preventDefault();
        var dataID = $(this).data('value'),
            isLast = $body.find('.remove-social').length;

        $.removeIziToast('deleteItemSocial', dataID, isLast);
    });

//////////     Website jQuery   //////////////

    var modal_add_website = $('#myModal3');
    var modal_edit_website = $('#myModal8');

    $('.addModalWebsite').on('click', function () {
        branch = $(this).parents('div.tab-pane');
        modal_add_website.modal({show: true, backdrop: 'static'});
    });

    $("#addWebsite").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[2];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyWebsites/add/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziAddWebsite-container');
                    return;
                } else {
                    var website_d_id = response.fields.Websites_d_id,
                        subject = response.fields.subject,
                        url = response.fields.url,
                        html = '<div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-website" data-value="' + website_d_id + '">' +
                            '<div class="container-input disable transition" data-toggle="tooltip" data-placement="bottom" title="">' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit editWebsite" data-value="' + website_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash deleteWebsite" data-value="' + website_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<span class="span-title">' + subject + '</span>' +
                            '<span class="span-report">' + url + '</span>' +
                            '<span class="submit-msg">تایید نشده</span>' +
                            '</div>' +
                            '</div>';
                    branch.find('.add-website').append(html);
                    branch.find('.website .notRecord').remove();
                    $('#addWebsite').find('input, textarea').each(function () {
                        $(this).val("");
                    });
                    modal_add_website.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $("#editWebsite").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[7];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyWebsites/edit/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziEditWebsite-container');
                    return;
                } else {
                    var website_d_id = response.fields.Websites_d_id,
                        website_d_id_old = response.fields.Websites_d_id_old,
                        website_d_id_oldest = response.fields.Websites_d_id_oldest,
                        subject = response.fields.subject,
                        url = response.fields.url;

                    $(".remove-website").each(function () {
                        if ($(this).data('value') == website_d_id_old || $(this).data('value') == website_d_id_oldest) {
                            $(this).data('value', website_d_id);
                            $(this).find('.deleteWebsite').data('value', website_d_id);
                            $(this).find('.editWebsite').data('value', website_d_id);
                            $(this).find('div.container-input').addClass('disable');
                            $(this).find('div.container-input').attr('data-original-title', 'تایید نشده');
                            $(this).find('.span-title').text(subject);
                            $(this).find('.span-report').text(url);
                        }
                    });
                    modal_edit_website.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $body.on('click', '.editWebsite', function (e) {
        e.preventDefault();
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemWebsite(dataID, $this);
    });

    function editItemWebsite(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $.post('/member/companyWebsites/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit_website.find('[name="' + key + '"]').val(value);
            });

            $body.find('input[type="text"], input[type="email"], input[type="name"], input[type="phone"], input[type="password"], textarea').each(function () {
                if ($(this).val().length != 0) {
                    $(this).parent().addClass('typing');
                }
            });

            modal_edit_website.modal({show: true, backdrop: 'static'});
        });
    }

    $body.on('click', '.deleteWebsite', function (e) {
        e.preventDefault();
        var dataID = $(this).data('value'),
            isLast = $body.find('.remove-website').length;

        $.removeIziToast('deleteItemWebsite', dataID, isLast);
    });

    //////////      Phone jQuery      ////////////////

    var modal_add_phone = $('#myModal5');
    var modal_edit_phone = $('#myModal10');

    $('.addModalPhone').on('click', function () {
        $("option:selected").prop("selected", false);
        $(".phone_value input").attr('disabled', 'disabled');
        branch = $(this).parents('div.tab-pane');
        modal_add_phone.modal({show: true, backdrop: 'static'});
    });

    $("#addPhone").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[4];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));
        formData.append('phoneType', $('.phoneType').data('value'));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyPhones/add/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziAddPhone-container');
                    return;
                } else {
                    var phone_d_id = response.fields.Phones_d_id,
                        subject = response.fields.subject,
                        number = response.fields.number,
                        code = response.fields.code,
                        state = response.fields.state,
                        valueState = response.fields.value,
                        html = '<div class="col-xs-12 col-sm-6 col-md-6 pull-right remove-phone" data-value="' + phone_d_id + '">' +
                            '<div class="container-input disable transition" data-toggle="tooltip" data-placement="bottom" title="">' +
                            '<div class="kebabMenu">' +
                            '<a><i class="icon-kebab-menu" aria-hidden="true"></i></a>' +
                            '<ul class="kebab-menu-content roundCorner boxBorder">' +
                            '<li><a class="link-edit editPhone" data-value="' + phone_d_id + '"><i class="fa fa-pencil" aria-hidden="true"></i><span>ویرایش </span></a></li>' +
                            '<li><a class="link-trash deletePhone" data-value="' + phone_d_id + '"><i class="fa fa-trash-o" aria-hidden="true"></i><span>حذف</span></a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<span class="span-title">' + subject + '</span>' +
                            '<span class="span-report rtl">' + code + ' - ' + number + '</span>' +
                            '<span class="span-report rtl">' + state + ' ' + valueState + '</span>' +
                            '<span class="submit-msg">تایید نشده</span>' +
                            '</div>' +
                            '</div>';
                    branch.find('.add-phone').append(html);
                    branch.find('.phone .notRecord').remove();
                    $('#addPhone').find('input, textarea').each(function () {
                        $(this).val("");
                    });
                    modal_add_phone.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $("#editPhone").on("submit", function (e) {
        e.preventDefault();

        var form = $('.form')[9];
        var formData = new FormData(form);
        formData.append('branch_id', $("div.active").data("value"));

        $('.errorHandler').text('');
        $.ajax({
            url: '/member/companyPhones/edit/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.fields.result == -1) {
                    $.iziToastError(response.fields.msg, '.iziEditPhone-container');
                    return;
                } else {
                    var phone_d_id = response.fields.Phones_d_id,
                        phone_d_id_old = response.fields.Phones_d_id_old,
                        phone_d_id_oldest = response.fields.Phones_d_id_oldest,
                        subject = response.fields.subject,
                        number = response.fields.number,
                        code = response.fields.code,
                        state = response.fields.state,
                        valueState = response.fields.value;

                    $(".remove-phone").each(function () {
                        if ($(this).data('value') == phone_d_id_old || $(this).data('value') == phone_d_id_oldest) {
                            $(this).data('value', phone_d_id);
                            $(this).find('.deletePhone').data('value', phone_d_id);
                            $(this).find('.editPhone').data('value', phone_d_id);
                            $(this).find('div.container-input').addClass('disable');
                            $(this).find('div.container-input').attr('data-original-title', 'تایید نشده');
                            $(this).find('.span-title').text(subject);
                            $(this).find('.span-report').first().text(code + ' - ' + number);
                            $(this).find('.span-report').last().text(state + ' ' + valueState);
                        }
                    });

                    modal_edit_phone.modal('hide');
                    $.iziToastSuccess(response.msg, '.izi-container');
                }
            }
        });
    });

    $body.on('click', '.editPhone', function (e) {
        e.preventDefault();
        var $this = $(this);
        var dataID = $(this).data('value');
        $('.errorHandler').text('');
        editItemPhone(dataID, $this);
    });

    function editItemPhone(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $("option:selected").prop("selected", false);
        $.post('/member/companyPhones/editAjax/', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit_phone.find('[name="' + key + '"]').val(value);
            });
            if (result.fields.value != "") {
                $('.phoneValue').val(result.fields.state);
                $(".phone_value").css("display", "block");
                $('.value1').val(result.fields.value);
            }
            else {
                $(".phone_value div input").attr("disabled", "disabled");
            }
            $body.find('input[type="text"], input[type="email"], input[type="name"], input[type="phone"], input[type="password"], textarea').each(function () {
                if ($(this).val().length != 0) {
                    $(this).parent().addClass('typing');
                }
            });
            modal_edit_phone.modal({show: true, backdrop: 'static'});
        });
    }

    $body.on('click', '.deletePhone', function (e) {
        e.preventDefault();
        var dataID = $(this).data('value'),
            isLast = $body.find('.remove-phone').length;

        $.removeIziToast('deleteItemPhone', dataID, isLast);
    });


    // Jquery Branch

    // Ad branch

    var modal_add = $('#modalAddBranch');

    $(".addBranchLink").on("click", function () {
        var dataID = $(this).data("value");
        getCity(dataID);
        modal_add.modal('show');
    });

    $("#addBranch").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[10];
        var formData = new FormData(form);
        $('.errorHandler').text('');
        $.ajax({
            url: '/branch/add/',
            type: 'post',
            data: formData,
            cash: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var response = $.parseJSON(data);
                if (response.result == -1) {
                    $.iziToastError(response.msg, '.iziAdd-container');
                }
                else {
                    modal_add.modal('hide');
                    e.preventDefault();
                    $('.errorHandler').text('');
                    location.reload();
                    return false;
                }
            }
        });
    });

    // Edit branch

    var modal_edit = $('#modalEditBranch');

    $(".editBranchs").on("click", function () {
        var dataID = $(this).data("value");
        editItem(dataID, $(this));
    });

    $("#editBranch").on("submit", function (e) {
        e.preventDefault();
        var form = $('.form')[11];
        var formData = new FormData(form);
        $.ajax({
            url: '/branch/editBranch/',
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                modal_edit.modal('hide');
                location.reload();
                return false;
            }
        });
    });

    function editItem(dataID, $this) {
        $this.find('input, textarea').each(function () {
            $this.val("");
        });
        $.post('/branch/getBranchByidAjax/', {Branch_id: dataID}, function (data) {
            var result = $.parseJSON(data);
            $('.province_id').append('<option value="0">استان را انتخاب کنید...</option>');
            $.each(result.provinces, function (key, value) {
                $('.province_id').append($('<option>', {
                    value: value.province_id,
                    text: value.name
                }));
            });
            $('.province_id').find('option[value="' + result.state_id + '"]').attr('selected', true);
            $('.city_id').append('<option value="0">شهر را انتخاب کنید...</option>');
            $.each(result.city, function (key, value) {
                $('.city_id').append($('<option>', {
                    value: value.City_id,
                    text: value.name
                }));
            });
            $('.city_id').find('option[value="' + result.city_id + '"]').attr('selected', true);

            var fields = result.fields;
            $.each(fields, function (key, value) {
                modal_edit.find('[name="' + key + '"]').val(value);
            });
            modal_edit.modal('show');
        });
    }

    // Delete branch

    $('.deleteBranch').on('click', function () {
        var Branch_id = $(this).data('value');
        $.post('/branch/delete', {id: Branch_id}, function (response) {
            location.reload();
            return false;
        });
    });

    // Get province and city
    function getCity(dataID) {
        $.post('/wiki/getProvince', {id: dataID}, function (data) {
            var result = $.parseJSON(data);
            $('.province_id').append('<option value="0">استان را انتخاب کنید...</option>');
            $.each(result.province, function (key, value) {
                $('.province_id').append($('<option>', {
                    value: value.province_id,
                    text: value.name
                }));
            });
            $('.province_id').find('option[value="' + result.state_id + '"]').attr('selected', true);
        });
    }

    // Change city with Ajax
    $('.province_id').on('change', function () {
        var province_id = $(this).val();
        $('.city_id').empty();
        $.post('/city/getCityByProvinceID', {province_id: province_id}, function (data) {
            var result = $.parseJSON(data);
            $('.city_id').append('<option value="0">شهرستان را انتخاب کنید...</option>');
            $.each(result, function (key, value) {
                $('.city_id').append($('<option>', {
                    value: value.City_id,
                    text: value.name
                }));
            });
        });

    });

    $.removeIziToast = function(funcName, id, isLast) {
        iziToast.question({
            title: "آیا از حذف این آیتم اطمینان دارید؟",
            close: false,
            backgroundColor: '#FFF',
            messageColor: 'red',
            color: 'green',
            icon: 'fa fa-question',
            iconColor: 'gray',
            rtl: true,
            closeOnEscape: false,
            toastOnce: true,
            overlay: true,
            overlayClose: true,
            overlayColor: 'rgba(0, 0, 0, 0.6)',
            drag: false,
            timeout: false,
            position: 'center',
            message: isLast === 1 ? "با حذف کردن این آیتم امتیاز مرتبط با این موضوع از امتیاز کل شما کسر خواهد شد" : "<p></p>",
            buttons: [
                ['<button class="btn btn-success btn-sm pull-right" style="margin-left: 1em;">بله</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    deleteAction[funcName](id);

                }, true],
                ['<button class="btn btn-danger btn-sm pull-left">انصراف</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
            ]
        });
    }

});
