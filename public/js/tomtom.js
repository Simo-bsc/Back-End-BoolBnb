// document.addEventListener('DOMContentLoaded', function() {
//   var options = {
//       searchOptions: {
//           key: "BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J",
//           language: "it-IT",
//           limit: 5,
//       },
//       autocompleteOptions: {
//           key: "BxLvW0WHQgAEf3K4FogUXlvUV2qjlM8J",
//           language: "it-IT",
//       }
//   };

//   var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
//   var searchBoxHTML = ttSearchBox.getSearchBoxHTML();

//   // Trova il campo di input "address" e il container dove inserire la search box
//   var addressInput = document.getElementById('address');
//   var searchBoxContainer = document.getElementById('search-box-container');

//   // Aggiungi la search box al container
//   searchBoxContainer.appendChild(searchBoxHTML);

//   let x = document.getElementsByClassName("tt-search-box-input");
//     x[0].setAttribute("name", "address");
//     x[0].setAttribute("value", "{{ old('address', $apartment->address) }}");

//   // Collega la search box al campo "address"
//   ttSearchBox.on('tomtom.searchbox.resultselected', function(result) {
//       addressInput.value = result.data.text;
//   });
// });
