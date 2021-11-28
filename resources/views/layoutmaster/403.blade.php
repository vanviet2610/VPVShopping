<!DOCTYPE html>
<html lang="en">

<head>
    <script src="{{ asset('admin/csscustom/js/pagenumber.js') }}" crossorigin="anonymous"></script>
</head>
<style>
    body {
        background-color: #A9A9A9;
    }

    .mainbox {
        background-color: #A9A9A9;
        margin: auto;
        height: 600px;
        width: 600px;
        position: relative;
    }

    .err {
        color: #ffffff;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 11rem;
        position: absolute;
        left: 20%;
        top: 8%;
    }

    .far {
        position: absolute;
        font-size: 8.5rem;
        left: 42%;
        top: 15%;
        color: #ffffff;
    }

    .err2 {
        color: #ffffff;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 11rem;
        position: absolute;
        left: 68%;
        top: 8%;
    }

    .msg {
        text-align: center;
        font-family: 'Nunito Sans', sans-serif;
        font-size: 1.6rem;
        position: absolute;
        left: 16%;
        top: 45%;
        width: 75%;
    }

    a {
        text-decoration: none;
        color: white;
    }

    a:hover {
        text-decoration: underline;
    }

</style>

<body>
    <div class="mainbox">
        <div class="err">4</div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2">3</div>
        <div class="msg">Bạn chưa đủ quyền để sử dụng lệnh hoặc truy cập nội dung này<p>Vui lòng di chuyển về
                lại <a href="#">Trang Chủ</a> có thể click tại đây.</p>
        </div>
    </div>

    <body>

</html>
