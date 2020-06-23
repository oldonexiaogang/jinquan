<?php
interface Milldeware {
    public static function handle(Closure $next);
}

class VerfiyCsrfToekn implements Milldeware {

    public static function handle(Closure $next)
    {

        $next();
        echo '验证csrf Token <br>';
    }
}

class VerfiyAuth implements Milldeware {

    public static function handle(Closure $next)
    {
        $next();
        echo '验证是否登录 <br>';

    }
}

class SetCookie implements Milldeware {
    public static function handle(Closure $next)
    {
        $next();
        echo '设置cookie信息！';
    }
}

$handle = function () {
    echo '当前要执行的程序!44444';
};

$pipe_arr = [
    'VerfiyCsrfToekn',
    'VerfiyAuth',
    'SetCookie',
];

function pipe ($stack,$pipe){
    return $pipe::handle($stack);
}

//$callback = array_reduce($pipe_arr,"pipe",$handle);
$callback = array_reduce($pipe_arr,function($stack,$pipe) {

    var_dump($stack);
    return function() use($stack,$pipe){
        return $pipe::handle($stack);
    };

},'handle111');


call_user_func($callback);


