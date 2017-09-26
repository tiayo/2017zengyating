<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <title>主页</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/reset.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/style/home/css/style.css') }}"/>
    <script src="{{ asset('/style/home/js/jquery.min.js') }}"></script>
</head>
<body>
<div class="index">
    <div class="index-search">
        <form id="search_form">
            <input type="text" id="search" placeholder="搜索门店"/>
        </form>
    </div>
    <div class="index-content">
        @foreach($lists as $store)
            <div class="shop clearfix">
                <div class="shop-name">
                    <h1>{{ $store['name'] }}</h1>
                    <a href="tel:{{ $store['phone'] }}" class="tel"></a>
                </div>
                <div class="shop-info clearfix">
                    <div class="shop-info-top">
                        <img src="{{ $store['avatar'] }}" class="portrait" />
                        <h1>{{ $store['phone'] }}</h1>
                        <h2>{{ $store['address'] }}</h2>
                    </div>
                    <div class="shop-info-bottom">
                        <h1>{{ $store['description'] }}</h1>
                        <a href="###" class="subscribe">预约</a>
                    </div>
                    <a href="###" class="shop-info-more">查看更多</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
{{--转换搜索链接--}}
<script type="text/javascript">
    $(document).ready(function () {

        $('#search_form').submit(function () {

            var keyword = $('#search').val();

            if (stripscript(keyword) == '') {
                $('#search').val('');
                return false;
            }

            window.location = '{{ route('home_store_search', ['keyword' => '']) }}/' + stripscript(keyword);

            return false;
        });

    });

    function stripscript(s)
    {
        var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");
        var rs = "";
        for (var i = 0; i < s.length; i++) {
            rs = rs+s.substr(i, 1).replace(pattern, '');
        }
        return rs;
    }
</script>
</body>
</html>