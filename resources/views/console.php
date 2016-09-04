<!DOCTYPE html>
<html>
<head>
    <title>Testwork - Console</title>
    <meta content="text/html" charset="utf-8"/>
    <link rel="stylesheet" href="/css/console.css">
    <script type="text/javascript" src="/console/loader.js"></script>
    <script type="text/html" id="layout">
        <div class="helper"></div>
        <div class="content">
            <div class="header"></div>
            <div class="params"></div>
            <div class="response"></div>
            <div class="statusbar"></div>
        </div>
    </script>
    <script type="text/html" id="helper">
        <div class="wrapper">
            <h2>Список методов</h2>
            <ul>

            </ul>
        </div>
        <div class="open-arrow"></div>
    </script>
    <script type="text/html" id="helper-item">
        <span></span> <a href="#" target="_blank">Docs</a>
    </script>
    <script type="text/html" id="header">
        <div class="method">get</div>
        <div class="urlbox"><span>part/of/</span><input value="helper identefication"/><span>/url/</span><input value="helper identefication"/></div>
        <button></button>
        <a href="/docs/index.html" target="_blank">Документация</a>
    </script>
    <script type="text/html" id="params">
        <h2>Параметры:</h2>
        <ul class="head"><li><label>Название параметра</label><label>Значение</label></li></ul>
        <ul class="list">

        </ul>
        <div class="buttons">
            <button class="clear">Очистить</button>
            <button class="append">Добавить параметр</button>
        </div>
    </script>
    <script type="text/html" id="params-item">
        <div class="input-wrapper"><input class="name"/></div><div class="input-wrapper"></lavel><input class="value"/></div><button>X</button>
    </script>
    <script type="text/html" id="response">
        <div class="wrap-box"><h2>Ответ</h2><div class="content response"></div></div>
    </script>
    <script type="text/html" id="status">
        <div class="code"></div><div class="status">Готов</div>
    </script>
</head>
<body>
    <div class="invisible-input-tester"></div>
    <div class="loading"></div>
</body>
</html>