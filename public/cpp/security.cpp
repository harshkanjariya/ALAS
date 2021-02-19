#include "base64.hpp"
#include <iostream>
#include <emscripten.h>
#include <emscripten/bind.h>

using namespace emscripten;
using namespace base64;

std::string decrypt(std::string value,std::string key){
    std::string dec = "";
    int last = 0;
    for (int i=0; i<value.length(); i++){
        int d = (int)value[i];
        d ^= key[i%key.length()];
        d ^= last;
        last = (int)value[i];
        dec = dec + ((char)d);
    }
    return dec;
}
emscripten::val convert(std::string inner){
    std::string atb;
    Base64::Decode(inner,atb);
    std::string pre = atb.substr(0,atb.find("::"));
    std::string post = atb.substr(atb.find("::")+2);
    std::string key = decrypt(post,"onmoving");
    key = key.substr(4);
    int len = atoi(key.substr(0,2).c_str());
    key = key.substr(2);
    int tlen = key.length()-len;
    key = key.substr(0,len);
    std::string result = decrypt(pre,key);
    return emscripten::val(result.substr(tlen));
}

EMSCRIPTEN_BINDINGS(my_module){
    function("decrypt",&decrypt);
    function("convert",&convert);
}