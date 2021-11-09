<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Laravel log viewer</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        body {
            padding: 25px;
        }

        h1 {
            font-size: 1.5em;
            margin-top: 0;
        }

        #table-log {
            font-size: 0.85rem;
        }

        .sidebar {
            font-size: 0.85rem;
            line-height: 1;
        }

        .btn {
            font-size: 0.7rem;
        }

        .stack {
            font-size: 0.85em;
        }

        .date {
            min-width: 75px;
        }

        .text {
            word-break: break-all;
        }

        a.llv-active {
            z-index: 2;
            background-color: #f5f5f5;
            border-color: #777;
        }

        .list-group-item {
            word-break: break-word;
        }

        .folder {
            padding-top: 15px;
        }

        .div-scroll {
            height: 80vh;
            overflow: hidden auto;
        }

        .nowrap {
            white-space: nowrap;
        }

        /**
        * DARK MODE CSS
        */
        body[data-theme="dark"] {
            background-color: #151515;
            color: #cccccc;
        }

        [data-theme="dark"] a {
            color: #4da3ff;
        }

        [data-theme="dark"] a:hover {
            color: #a8d2ff;
        }

        [data-theme="dark"] .list-group-item {
            background-color: #1d1d1d;
            border-color: #444;
        }

        [data-theme="dark"] a.llv-active {
            background-color: #0468d2;
            border-color: rgba(255, 255, 255, 0.125);
            color: #ffffff;
        }

        [data-theme="dark"] a.list-group-item:focus, [data-theme="dark"] a.list-group-item:hover {
            background-color: #273a4e;
            border-color: rgba(255, 255, 255, 0.125);
            color: #ffffff;
        }

        [data-theme="dark"] .table td, [data-theme="dark"] .table th, [data-theme="dark"] .table thead th {
            border-color: #616161;
        }

        [data-theme="dark"] .page-item.disabled .page-link {
            color: #8a8a8a;
            background-color: #151515;
            border-color: #5a5a5a;
        }

        [data-theme="dark"] .page-link {
            background-color: #151515;
            border-color: #5a5a5a;
        }

        [data-theme="dark"] .page-item.active .page-link {
            color: #fff;
            background-color: #0568d2;
            border-color: #007bff;
        }

        [data-theme="dark"] .page-link:hover {
            color: #ffffff;
            background-color: #0051a9;
            border-color: #0568d2;
        }

        [data-theme="dark"] .form-control {
            border: 1px solid #464646;
            background-color: #151515;
            color: #bfbfbf;
        }

        [data-theme="dark"] .form-control:focus {
            color: #bfbfbf;
            background-color: #212121;
            border-color: #4a4a4a;
        }

        .modal {
            padding: 0 !important;
        / / override inline padding-right added from js
        }

        .modal .modal-dialog {
            width: 100%;
            max-width: none;
            height: 100%;
            margin: 0;
        }

        .modal .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-body {
            overflow-y: auto;
        }

        .custom-checkbox {
            min-height: 1rem;
            padding-left: 0;
            margin-right: 0;
            cursor: pointer;
        }

        .custom-checkbox .custom-control-indicator {
            content: "";
            display: inline-block;
            position: relative;
            width: 30px;
            height: 10px;
            background-color: #818181;
            border-radius: 15px;
            margin-right: 10px;
            -webkit-transition: background .3s ease;
            transition: background .3s ease;
            vertical-align: middle;
            margin: 0 16px;
            box-shadow: none;
        }

        .custom-checkbox .custom-control-indicator:after {
            content: "";
            position: absolute;
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: #f1f1f1;
            border-radius: 21px;
            box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
            left: -2px;
            top: -4px;
            -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
            transition: left .3s ease, background .3s ease, box-shadow .1s ease;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
            background-color: #28a745;
            background-image: none;
            box-shadow: none !important;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
            background-color: #28a745;
            left: 15px;
        }

        .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
            box-shadow: none !important;
        }
    </style>
</head>
<body>
<form>
    <div class="form-group">
        <h1 style="float: left">Uri: {{request()->root().''.$uri}}</h1>
    </div>
    <div class="clearfix"></div>
    <div class="form-group">
        <label class="custom-control custom-checkbox">
            <h1 style="float: left">Security:</h1>
            <input type="checkbox" class="custom-control-input" {{  ($data['security'] == true ? ' checked' : '') }}>
            <span class="custom-control-indicator"></span>
        </label>
    </div>
    <div class="form-group">
        <label class="col-form-label">
            <h1 style="float: left">
                Summary:
            </h1>
        </label>
        <textarea class="form-control">
            {{$data['summary']}}
        </textarea>
    </div>
    <div class="form-group">
        <label class="col-form-label custom-checkbox">
            <h1 style="float: left">Parameters:</h1>
            <input type="checkbox" id="modal_parameters"
                   class="custom-control-input" {{  (count($data['parameters']) > 0 ? ' checked' : '') }}>
            <span class="custom-control-indicator"></span>
        </label>
        <label class="col-form-label float-right"
               id="modal_parameter_more" {{  count($data['parameters']) == 0 ? "style='display: none'" : '' }}>
            <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                    onclick="addMoreParameter()">
                <span class="fa fa-plus"></span>
            </button>
        </label>
        <div id="parameterDetail" {{  (count($data['parameters']) > 0 ? ' style="display: none"' : '') }}>
            <div class="form-group">
                <textarea class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-form-label">
            <h1 style="float: left">Responses:</h1>
        </label>
        <label class="col-form-label float-right">
            <button type="button" class="float-right expand btn btn-outline-dark btn-sm mb-2 ml-2"
                    onclick="addMoreResponse()">
                <span class="fa fa-plus"></span>
            </button>
        </label>
        <table class="table table-striped" id="modal_responses">
            <thead>
            <tr>
                <th>Status Code</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</form>
<!-- jQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<!-- FontAwesome -->
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<!-- Datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script>
    function addMoreResponse() {
        var modal = $('#exampleModal')
        var tbody = modal.find('.modal-body #modal_responses tbody').html();
        tbody += '<tr><td><input type="text" class="form-control" value=""></td>' +
            '<td><textarea class="form-control"></textarea></td></tr>';
        modal.find('.modal-body #modal_responses tbody').html(tbody)
    }

    function addMoreParameter() {
        var tbody = $('#modal_parameter_details').find('tbody').html();
        tbody += '<tr><td><textarea cols="20" rows="10" class="form-control"></textarea></td></tr>';
        $('#modal_parameter_details').find('tbody').html(tbody)
    }

    $(document).ready(function () {
        var root = '{{request()->root()}}';
        var data = @json($data, JSON_PRETTY_PRINT);
        $('#modal_parameters').change('change', function () {
            if ($(this).is(':checked')) {
                $("#modal_parameter_details").show()
                $("#modal_parameter_more").show()
            } else {
                $("#modal_parameter_details").hide()
                $("#modal_parameter_more").hide()
            }
        })
        // $('#exampleModal').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget)
        //     var uri = button.data('uri')
        //     var method = button.data('method')
        //     var item = data[uri][method];
        //     console.log(item)
        //     var modal = $(this)
        //     modal.find('.modal-title').text('Update uri : ' + root + uri)
        //     if (item['security'].length > 0) {
        //         modal.find('.modal-body #modal_security').prop("checked", true)
        //     } else {
        //         modal.find('.modal-body #modal_security').prop("checked", false)
        //     }
        //     if (item['parameters'].length > 0) {
        //         modal.find('.modal-body #modal_parameters').prop("checked", true)
        //         $("#modal_parameter_details").show()
        //         $("#modal_parameter_more").show()
        //     } else {
        //         modal.find('.modal-body #modal_parameters').prop("checked", false)
        //         $('#modal_parameter_details').hide()
        //         $('#modal_parameter_more').hide()
        //     }
        //     modal.find('.modal-body #modal_summary').val(item['summary'])
        //     modal.find('.modal-body #modal_parameter_details tbody').empty();
        //     var tbody = '';
        //     _.forEach(item['parameters'], function (item) {
        //         tbody += '<tr><td><textarea cols="20" rows="10" class="form-control">' + JSON.stringify(item, undefined, 4) + '</textarea></td></tr>';
        //         console.log(item);
        //     });
        //     modal.find('.modal-body #modal_parameter_details tbody').html(tbody)
        //
        //     modal.find('.modal-body #modal_responses tbody').empty();
        //     var tbody = '';
        //     _.forEach(item['responses'], function (item, code) {
        //         tbody += '<tr><td><input type="text" class="form-control" value="' + code + '"></td>' +
        //             '<td><textarea class="form-control">' + item['description'] + '</textarea></td></tr>';
        //         console.log(code, item);
        //     });
        //     modal.find('.modal-body #modal_responses tbody').html(tbody)
        //     // item['responses'].forEach((element, index) => {
        //     //     console.log(index); // 0, 1, 2
        //     //     console.log(element); // same myArray object 3 times
        //     // });
        //     // <tr>
        //     //     <td>Status Code</td>
        //     //     <td>Description</td>
        //     // </tr>
        // })
        $("#select_tags").select2({
            tags: true
        });
        $('.table-container tr').on('click', function () {
            $('#' + $(this).data('display')).toggle();
        });
        // $('#table-log').DataTable({
        //     "stateSave": true,
        //     "stateSaveCallback": function (settings, data) {
        //         window.localStorage.setItem("datatable", JSON.stringify(data));
        //     },
        //     "stateLoadCallback": function (settings) {
        //         var data = JSON.parse(window.localStorage.getItem("datatable"));
        //         if (data) data.start = 0;
        //         return data;
        //     }
        // });
        // $('#delete-log, #clean-log, #delete-all-log').click(function () {
        //     return confirm('Are you sure?');
        // });
    });
</script>
</body>
</html>
