// Load the Google Transliteration API

google.load("elements", "1", {

    packages: "transliteration"

});



function onLoad() {

    var options = {

        sourceLanguage: 'en',

        destinationLanguage: ['ml', 'hi','kn','ta','te'],

        shortcutKey: 'ctrl+m',

        transliterationEnabled: true

    };



    // Create an instance on TransliterationControl with the required

    // options.

    var control =

        new google.elements.transliteration.TransliterationControl(options);



    // Enable transliteration in the textfields with the given ids.

    var ids = [ "input-kanji" ];

    control.makeTransliteratable(ids);



    // Show the transliteration control which can be used to toggle between

    // English and Hindi and also choose other destination language.
    eletranslControl = document.createElement( "div" );
    eletranslControl.setAttribute("id", "translControl");
    jQuery("body").append(eletranslControl);
    control.showControl('translControl');

}

google.setOnLoadCallback(onLoad);