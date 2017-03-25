window.addEventListener("load", function() {
        var img = document.getElementById("img");
        img.onclick=expandImg(img, 1.5);
    }, false);

/**
 * 画像を縮小・拡大する
 *
 * @param  string    拡大するimgタグのID
 * @param  number    拡大率 > 1
 * @return function
 */
function expandImg(img, rate) {
    var normal_size = img.height;
    var isExpanded = false;
    return function() {
        if (!isExpanded) {
            img.height *= rate; // rateの分だけ拡大
        } else {
            img.height = normal_size; // 元のサイズに戻す
        }
        isExpanded = !isExpanded; // 状態を切替
    };
}

