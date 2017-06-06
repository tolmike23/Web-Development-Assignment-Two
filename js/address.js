(function(){
  var widget,
    initAF = function(){
      /* First, we turn the first address input in your form into an autocomplete field */
      widget = new AddressFinder.Widget(
        /* Update 'address_line_1' to the id of the first address field in your form */
        document.getElementById('address_line_1'),
        /* Update 'demo_api_key' to your licence key to remove the demo message from
           the autocomplete field  */
        'GTH8DAM3E6CVJQ9UW7YK',
        /* Change 'NZ' to 'AU' if you want to look up Australian addresses instead */
        'NZ'
      );

      widget1 = new AddressFinder.Widget(
        /* Update 'address_line_1' to the id of the first address field in your form */
        document.getElementById('destSuburb'),
        /* Update 'demo_api_key' to your licence key to remove the demo message from
           the autocomplete field  */
        'GTH8DAM3E6CVJQ9UW7YK',
        /* Change 'NZ' to 'AU' if you want to look up Australian addresses instead */
        'NZ'
      );

      /* Next, we tell AddressFinder to populate all the address inputs in your form
         - Update 'address_line_1', 'address_line_2', 'suburb', 'city', 'postcode' to
         the ids of the matching inputs in your form
         - If you don't have an input in your field, delete the line below
         (e.g. document.getElementById('address_line_2').value = selected.address_line_2())
         - If your address inputs are different, see how to connect AddressFinder to them
         here: https://addressfinder.nz/docs/address_info_api_response/
       */
      widget.on('result:select', function(fullAddress, metaData) {
        var selected = new AddressFinder.NZSelectedAddress(fullAddress, metaData);


        document.getElementById('address_line_1').value = selected.address_line_1();
        document.getElementById('address_line_2').value = selected.address_line_2();
        document.getElementById('pickSuburb').value = selected.suburb();
        document.getElementById('city').value = selected.city();
        document.getElementById('postcode').value = selected.postcode();
      });

    };

  /* You don't need to update anything else. This tells your browser to load
  AddressFinder last so it doesn't slow down your website */
  function downloadAF(f){
    var script = document.createElement('script');
    script.src = 'https://api.addressfinder.io/assets/v3/widget.js';
    script.async = true;
    script.onload = f;
    document.body.appendChild(script);
  };

  document.addEventListener('DOMContentLoaded', function(){
    downloadAF(initAF);
  });

})();