'use strict';

/*
chrome.runtime.onInstalled.addListener(function() {
  chrome.storage.sync.set({number: 1}, function() {
    console.log('The number is set to 1.');
  });
});
*/

function updateBrowserAction(isEndable) {
    if( typeof isEndable === 'undefined' ){
        isEndable = false;
    }

    if( isEndable ){
        chrome.browserAction.setIcon({path: 'images/torii-32.png'});
    } else {
        chrome.browserAction.setIcon({path: 'images/torii-32-black.png'});
    }
    /*
  chrome.storage.sync.get('number', function(data) {
    var current = data.number;
    chrome.browserAction.setIcon({path: 'images/icon' + current + '.png'});
    current++;
    if (current > 5)
      current = 1;
    chrome.storage.sync.set({number: current}, function() {
      console.log('The number is set to ' + current);
    });
  });
  */
};

//chrome.browserAction.onClicked.addListener(updateIcon);

updateBrowserAction(false);

function checkSite(url){
    var location = document.createElement("a");
    location.href = url;
    if (location.host == "") {
      location.href = location.href;
    }

    var sites = [
        'j-dict.com',
        'mina.mazii.net'
    ];
    
    if( sites.indexOf(location.host) > -1 ){
        updateBrowserAction(true);
    } else {
        updateBrowserAction(false);
    }
}

chrome.tabs.onUpdated.addListener(function(tabId, changeInfo, tab) {
    checkSite(tab.url);
});

chrome.tabs.onActivated.addListener(function(activeInfo, tab) {
    checkSite();
    //alert('on active tab',{tab});
});