#include <iostream>
#include <emscripten.h>
#include <emscripten/bind.h>

using namespace emscripten;

void test(){
    EM_ASM({
        console.log('hii');
    });
}

EMSCRIPTEN_BINDINGS(my_module){
    function("test",&test);
}