var HelperFunctions = class {
    static isMobile(navigator){
        var str = navigator.appVersion.toString();
        str = str.toLowerCase();
        if (str.includes("Android".toLowerCase())) return true;
        if (str.includes("ios".toLowerCase())) return true;
        return false;
    };
};