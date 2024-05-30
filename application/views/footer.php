
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#gotologin').click(function() {
        location.replace("<?=site_url('login/index')?>");
    });
    $('#gotosignup').click(function() {
        location.replace("<?=site_url('register/index')?>");
    });
    $('#signup-button').click(function() {
        var data = $('#form').serialize();
        $.ajax({
            url: '<?=site_url("register/validateData")?>', 
            type: 'POST', 
            data: { data: data },
            success: function(data) {
                if (data == '') {
                    $('#error-message').html('');
                    Swal.fire({
                        title: "Success",
                        text: "Please take note that your password will be the capital letter of your Lastname.",
                        icon: "success",
                        showDenyButton: false,
                        showCancelButton: false,
                        confirmButtonText: "okay",
                        allowOutsideClick: false
                        }).then((result) => {
                        if (result.isConfirmed) {
                            location.replace("<?=site_url('login/index')?>");
                        }
                    });
                }else {
                    $('#error-message').html(data);
                }
            }
        })

    });

    $('#login-button').click(function() {
        var data = $('#login-form').serialize();
        $.ajax({
            url: '<?=site_url('login/login')?>',
            type: 'POST', 
            data: { data: data },
            success: function (data) {
                if (data == '') {
                    location.replace("<?=site_url('admin/index')?>");
                }else {
                    $('#login-error').html(data);
                }
            }
        });
    });

    $('input[name="birthdate"]').on('change', function() {
        var birthdate = $(this).val();
        $.ajax({
            url: '<?=site_url('register/calculateAge')?>',
            type: 'POST',
            dataType: 'json',
            data: { birthdate: birthdate},
            success: function(data) {
                $('input[name="age"]').val(data.age);
            }
        });
    });
    $('input[name="admin-birthdate"]').on('change', function() {
        var birthdate = $(this).val();
        $.ajax({
            url: '<?=site_url('register/calculateAge')?>',
            type: 'POST',
            dataType: 'json',
            data: { birthdate: birthdate},
            success: function(data) {
                $('input[name="admin-age"]').val(data.age);
            }
        });
    });

    $('#update-password').click(function() {
        $.ajax({
            url: '<?=site_url('client/clientChangePass')?>',
            success: function () {
                location.replace('<?=site_url('client/index')?>');
            }
        });
    });

    $('#change-password').click(function() {
        var data = $('#change-form').serialize();
        $.ajax({
            url: '<?=site_url('client/changePass')?>',
            type: 'POST',
            data: { data: data },
            success: function (data) {
                if (data == ''){
                    location.replace("<?=site_url('client/index')?>");
                }else {
                    $('#change-error').html(data);
                }
            }
        });
    });
    

    $('#sign-out-button').click(function() {
        Swal.fire({
            title: "Continue to sign out?",
            showCancelButton: true,
            confirmButtonText: "Yes",
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=site_url('client/logout')?>',
                    success: function () {
                        location.replace("<?=site_url('login/index')?>");
                    }
                });
            }
        });
    });
    function loadAdmin() {
        $('#adminlist').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?=site_url('admin/getAdmins')?>",
                "type": "POST"
            },
            "columnDefs": [{ 
                "targets": [0, 1],
                "orderable": false
            }]
        });
    }
    loadAdmin();
    function loadData() {
        $('#userlist').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?=site_url('admin/getList')?>",
                "type": "POST"
            },
            "columnDefs": [{ 
                "targets": [0, 1],
                "orderable": false
            }]
        });
    }
    loadData();

    $('#admin-list').click(function () {
        $(this).attr('class', 'active');
        $('#client-list').removeAttr('class');
        $('#admin-table').toggle();
        $('#client-table').toggle();
    });
    $('#client-list').click(function () {
        $(this).attr('class', 'active');
        $('#admin-list').removeAttr('class');
        $('#client-table').toggle();
        $('#admin-table').toggle();
    });

    $('#userlist').delegate('#action', 'click', function() {
        var id = $(this).attr('tag');
        var value = $(this).attr('action');
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?=site_url('admin/updateUser')?>',
                    type: 'POST',
                    data: { id: id, value: value}, 
                    success: function () {
                        Swal.fire({
                        title: "Updated!",
                        text: "The status has been updated.",
                        icon: "success"
                        });
                    }
                });
                $('#userlist').DataTable().destroy();
                loadData();
            }
        });
    });
    $('#userlist').delegate('#admin-change', 'click', function () {
        var id = $(this).attr('tag');
        $('#save-client-change-pass').attr('tag', id)
        $('#container-modal-admin-pass-update').toggle();
    });
    $('#save-client-change-pass').click(function() {
        var id = $(this).attr('tag');
        var data = $('#client-change-password').serialize();
        $.ajax({
            url: "<?=site_url('admin/adminUpdateClientPass')?>",
            type: 'POST',
            data: { data: data, id: id},
            success: function (data) {
                if (data == ''){
                    Swal.fire({
                        title: "Updated!",
                        text: "The password has been updated.",
                        icon: "success"
                    });
                }else {
                    $('#admin-change-client-error').html(data);
                }
            }
        });
        $('#container-modal-admin-pass-update').toggle();
    });
    $('#addAdmin').click(function () {
        $('#container-modal-add-admin').toggle();
    });
    $('#add-new-admin').click(function () {
        //$('#container-modal-add-admin').toggle();
        var data = $('#add-admin-form').serialize();
        $.ajax({
            url: "<?=site_url('admin/addAdmin')?>",
            type: 'POST',
            data: { data: data }, 
            success: function (data) {
                if (data == '') {
                    $('#container-modal-add-admin').toggle();
                    Swal.fire({
                        title: "Added!",
                        text: "The account is created",
                        icon: "success"
                    });
                    $('#adminlist').DataTable().destroy();
                    loadAdmin();
                }else {
                    $('#admin-add-error').html(data);
                }
            }
        });
        
    });

    $('#adminlist').delegate('#admin-action', 'click', function () {
        var id = $(this).attr('tag');
        var value = $(this).attr('action');
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=site_url('admin/updateAdmin')?>",
                    type: 'POST', 
                    data: { id: id, value: value },
                    success: function (data) {
                        if (data == '') {
                            Swal.fire({
                                title: "Updated!",
                                text: "The account is updated",
                                icon: "success"
                            });
                            $('#adminlist').DataTable().destroy();
                            loadAdmin();
                        }else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Something went wrong!"
                            });
                        }
                    }
                });
            }
        });
    });

    $('#adminlist').delegate('#admin-account-change', 'click', function () {
        var id = $(this).attr('tag');
        $('#container-change-admin-pass').toggle();
        $('#save-admin-change-pass').attr('tag', id);
    });
    $('#save-admin-change-pass').click(function() {
        var id = $(this).attr('tag');
        var formdata = $('#admin-change-password').serialize();
        $.ajax({
            url: "<?=site_url('admin/adminUpdateAdminPass')?>",
            type: 'POST',
            data: { id: id, formdata: formdata},
            success: function (data) {
                if (data == '') {
                    $('#container-change-admin-pass').toggle();
                    Swal.fire({
                        title: "Updated!",
                        text: "The account is updated",
                        icon: "success"
                    });
                }else if (data == '*something went wrong'){
                    $('#container-change-admin-pass').toggle();
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!"
                    });
                }else {
                    $('#admin-change-admin-error').html(data);
                }
            }
        });
    });
</script>
</html>