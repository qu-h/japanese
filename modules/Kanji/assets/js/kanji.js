jQuery( document ).ready(function() {
    var word = jQuery('#kanjiViewer');

    KanjiViewer.initialize(
        "kanjiViewer",
        3,
        5,
        100,
        true,
        false,
        word.get(0).dataset.value
    );
});