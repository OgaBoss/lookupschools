/**
 * Created by OluwadamilolaAdebayo on 2/21/16.
 */
    $(document).ready(function() {
//                var locations = [
//                    ['Bondi Beach', -33.890542, 151.274856, 4],
//                    ['Coogee Beach', -33.923036, 151.259052, 5],
//                    ['Cronulla Beach', -34.028249, 151.157507, 3],
//                    ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
//                    ['Maroubra Beach', -33.950198, 151.259302, 1]
//                ];
//
//                var map = new google.maps.Map(document.getElementById('map'), {
//                    zoom: 10,
//                    center: new google.maps.LatLng(-33.92, 151.25),
//                    mapTypeId: google.maps.MapTypeId.ROADMAP
//                });
//
//                var infowindow = new google.maps.InfoWindow();
//
//                var marker, i;
//
//                for (i = 0; i < locations.length; i++) {
//                     marker = new google.maps.Marker({
//                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
//                        map: map
//                    });
//
//                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
//                        return function() {
//                            infowindow.setContent(locations[i][0]);
//                            infowindow.open(map, marker);
//                        }
//                    })(marker, i));
//                }


        var stateArea = {
            lagos : ["Agege", "Ajeromi-Ifelodun", "Alimosho", "Amuwo-Odofin", "Apapa", "Badagry", "Epe", "Eti-Osa", "Ibeju/Lekki", "Ifako-Ijaye",  "Ikeja", "Ikorodu", "Kosofe", "Lagos Island", "Lagos Mainland", "Mushin", "Ojo", "Oshodi-Isolo", "Shomolu", "Surulere"],
            fct : ["Gwagwalada", "Kuje", "Abaji", "Abuja", "Municipal", "Bwari", "Kwali"],
            abia : ["Aba North", "Aba South", "Arochukwu", "Bende", "Ikwuano", "Isiala-Ngwa North", "Isiala-Ngwa South", "Suikwato", "Obi Nwa", "Ohafia", "Osisioma", "Ngwa", "Ugwunagbo", "Ukwa East", "Ukwa West", "Umuahia North", "Umuahia South", "Umu-Neochi"],
            adamawa : ["Demsa", "Fufore", "Ganaye", "Gireri", "Gombi", "Guyuk", "Hong", "Jada", "Lamurde", "Madagali", "Maiha", "Mayo-Belwa", "Michika", "Mubi North", "Mubi South", "Numan", "Shelleng", "Song", "Toungo", "Yola North", "Yola South"],
            akwa_ibom : ["Abak", "Eastern Obolo", "Eket", "Esit Eket", "Essien Udim", "Etim Ekpo", "Etinan", "Ibeno", "Ibesikpo Asutan", "Ibiono Ibom", "Ika", "Ikono", "Ikot Abasi", "Ikot Ekpene", "Ini", "Itu", "Mbo", "Mkpat Enin", "Nsit Atai", "Nsit Ibom", "Nsit Ubium", "Obot Akara", "Okobo", "Onna", "Oron", "Oruk Anam", "Udung Uko", "Ukanafun", "Uruan", "Urue-Offong/Oruko", "Uyo"],
            anambra : ["Aguata", "Anambra East", "Anambra West", "Anaocha", "Awka North", "Awka South", "Ayamelum",	"Dunukofia", "Ekwusigo", "Idemili North", "Idemili south", "Njikoka", "Nnewi North", "Nnewi South", "Ogbaru", "Onitsha South", "Orumba North", "Orumba South", "Oyi"],
            bauchi : ["Alkaleri", "Bauchi", "Bogoro", "Damban", "Darazo", "Dass", "Ganjuwa", "Giade", "Itas/Gadau", "Jama'are", "Katagum", "Kirfi", "Misau", "Ningi", "Shira", "Tafawa-Balewa", "Toro", "Warji", "Zaki"],
            bayelsa : ["Brass", "Ekeremor", "Kolokuma/Opokuma", "Nembe", "Ogbia", "Sagbama", "Southern Jaw", "Yenegoa"],
            benue : ["Ado", "Agatu", "Apa", "Buruku", "Gboko", "Guma", "Gwer East", "Gwer West", "Katsina-Ala", "Konshisha", "Kwande", "Logo", "Makurdi", "Obi", "Ogbadibo", "Oju", "Okpokwu", "Ohimini", "Oturkpo", "Tarka", "Ukum", "Ushongo", "Vandeikya" ],
            bornu : ["Abadam", "Askira/Uba", "Bama", "Bayo", "Biu", "Chibok", "Damboa", "Dikwa", "Gubio", "Guzamala", "Gwoza ", "Hawul", "Jere", "Kaga", "Kala/Balge", "Konduga", "Kukawa", "Kwaya Kusar", "Mafa", "Magumeri", "Maiduguri", "Marte", "Mobbar", "Monguno", "Ngala", "Nganzai", "Shani"],
            cross_river : ["Akpabuyo", "Odukpani", "Akamkpa", "Biase", "Abi", "Ikom", "Yarkur", "Odubra", "Boki", "Ogoja", "Yala", "Obanliku", "Obudu", "Calabar South", "Etung", "Bekwara", "Bakassi", "Calabar Municipality"],
            delta : ["Oshimili", "Aniocha", "Aniocha South", "Ika South", "Ika North-East", "Ndokwa West", "Ndokwa East", "Isoko south", "Isoko North", "Bomadi", "Burutu", "Ughelli South", "Ughelli North", "Ethiope West", "Ethiope East", "Sapele", "Okpe", "Warri North", "Warri South", "Uvwie", "Udu", "Warri Central", "Ukwani", "Oshimili North", "Patani"],
            ebonyi : ["Afikpo South", "Afikpo North", "Onicha","Ohaozara", "Abakaliki", "Ishielu", "lkwo", "Ezza", "Ezza South", "Ohaukwu", "Ebonyi", "Ivo"],
            edo : ["Esan North-East", "Esan Central", "Esan West", "Egor", "Ukpoba", "Central", "Etsako Central", "Igueben", "Oredo", "Ovia SouthWest", "Ovia South-East", "Orhionwon", "Uhunmwonde", "Etsako East",  "Esan South-East"],
            ekiti : ["Ado", "Ekiti-East", "Ekiti-West",  "Emure/Ise/Orun", "Ekiti South-West", "Ikare", "Irepodun", "Ijero,",  "Ido/Osi", "Oye", "Ikole", "Moba", "Gbonyin", "Efon", "Ise/Orun",  "Ilejemeje"],
            enugu : ["Enugu South", "Igbo-Eze South", "Enugu North", "Nkanu", "Udi Agwu", "Oji-River", "Ezeagu", "IgboEze North", "Isi-Uzo", "Nsukka", "Igbo-Ekiti", "Uzo-Uwani", "Enugu Eas", "Aninri", "Nkanu East", "Udenu"],
            gombe : ["Akko", "Balanga", "Billiri", "Dukku", "Kaltungo", "Kwami", "Shomgom", "Funakaye", "Gombe", "Nafada/Bajoga",  "Yamaltu/Delta"],
            imo : ["Aboh-Mbaise", "Ahiazu-Mbaise", "Ehime-Mbano", "Ezinihitte", "Ideato North", "Ideato South", "Ihitte/Uboma", "Ikeduru", "Isiala Mbano", "Isu", "Mbaitoli", "Ngor-Okpala", "Njaba", "Nwangele", "Nkwerre","Obowo", "Oguta", "Ohaji/Egbema", "Okigwe", "Orlu", "Orsu", "Oru East", "Oru West", "Owerri-Municipal", "Owerri North", "Owerri West"],
            jigawa : ["Auyo", "Babura", "Birni Kudu","Biriniwa","Buji", "Dutse", "Gagarawa", "Garki", "Gumel", "Guri", "Gwaram", "Gwiwa", "Hadejia", "Jahun ","Kafin Hausa", "Kaugama Kazaure", "Kiri Kasamma", "Kiyawa", "Maigatari", "Malam Madori", "Miga", "Ringim", "Roni", "Sule-Tankarkar", "Taura",  "Yankwashi"],
            kaduna : ["Birni-Gwari", "Chikun", "Giwa", "Igabi", "Ikara", "jaba", "Jema'a", "Kachia", "Kaduna North", "Kaduna South", "Kagarko", "Kajuru", "Kaura","Kauru", "Kubau", "Kudan", "Lere", "Makarfi", "Sabon-Gari", "Sanga", "Soba", "Zango-Kataf", "Zaria"],
            kano : ["Ajingi", "Albasu", "Bagwai", "Bebeji", "Bichi", "Bunkure", "Dala", "Dambatta", "Dawakin Kudu", "Dawakin Tofa", "Doguwa", "Fagge", "Gabasawa", "Garko", "Garum", "Mallam", "Gaya", "Gezawa", "Gwale", "Gwarzo", "Kabo", "Kano Municipal", "Karaye", "Kibiya ","Kiru", "kumbotso", "Kunchi", "Kura", "Madobi", "Makoda", "Minjibir", "Nasarawa", "Rano", "Rimin Gado", "Rogo", "Shanono", "Sumaila", "Takali", "Tarauni", "Tofa", "Tsanyawa", "Tudun Wada", "Ungogo", "Warawa", "Wudil"],
            katsina : ["Bakori", "Batagarawa", "Batsari", "Baure", "Bindawa", "Charanchi", "Dandume", "Danja", "Dan Musa", "Daura", "Dutsi", "Dutsin-Ma", "Faskari", "Funtua", "Ingawa", "Jibia", "Kafur", "Kaita", "Kankara", "Kankia", "Katsina", "Kurfi", "Kusada", "Mai'Adua", "Malumfashi", "Mani", "Mashi", "Matazuu", "Musawa", "Rimi", "Sabuwa", "Safana", "Sandamu", "Zango"],
            kebbi : ["Aleiro", "Arewa-Dandi", "Argungu", "Augie", "Bagudo", "Birnin Kebbi", "Bunza", "Dandi",  "Fakai", "Gwandu", "Jega", "Kalgo",  "Koko/Besse", "Maiyama", "Ngaski", "Sakaba", "Shanga", "Suru", "Wasagu/Danko", "Yauri","Zuru" ],
            kogi : ["Adavi", "Ajaokuta", "Ankpa", "Bassa","Dekina", "Ibaji", "Idah", "Igalamela-Odolu", "Ijumu", "Kabba/Bunu", "Kogi", "Lokoja", "Mopa-Muro", "Ofu", "Ogori/Mangongo", "Okehi", "Okene", "Olamabolo", "Omala", "Yagba East",  "Yagba West",],
            kwara : ["Asa", "Baruten", "Edu", "Ekiti", "Ifelodun", "Ilorin East", "Ilorin West", "Irepodun", "Isin", "Kaiama", "Moro", "Offa", "Oke-Ero", "Oyun", "Pategi"],
            nasarawa : ["Akwanga", "Awe", "Doma", "Karu", "Keana", "Keffi", "Kokona", "Lafia", "Nasarawa", "Nasarawa-Eggon", "Obi", "Toto", "Wamba"],
            niger : ["Agaie", "Agwara", "Bida", "Borgu", "Bosso", "Chanchaga", "Edati", "Gbako", "Gurara", "Katcha", "Kontagora",  "Lapai", "Lavun", "Magama", "Mariga", "Mashegu", "Mokwa", "Muya", "Pailoro", "Rafi", "Rijau", "Shiroro", "Suleja", "Tafa", "Wushishi"],
            ogun : ["Abeokuta North", "Abeokuta South", "Ado-Odo/Ota", "Egbado North", "Egbado South", "Ewekoro", "Ifo", "Ijebu East", "Ijebu North", "Ijebu North East", "Ijebu Ode", "Ikenne", "Imeko-Afon", "Ipokia", "Obafemi-Owode", "Ogun Waterside", "Odeda", "Odogbolu", "Remo North", "Shagamu"],
            ondo : ["Akoko North East", "Akoko North West", "Akoko South Akure East", "Akoko South West", "Akure North", "Akure South", "Ese-Odo", "Idanre", "Ifedore", "Ilaje", "Ile-Oluji", "Okeigbo", "Irele", "Odigbo", "Okitipupa", "Ondo East", "Ondo West", "Ose", "Owo"],
            osun : ["Aiyedade", "Aiyedire", "Atakumosa East", "Atakumosa West", "Boluwaduro", "Boripe", "Ede North", "Ede South", "Egbedore", "Ejigbo", "Ife Central", "Ife East", "Ife North", "Ife South", "Ifedayo", "Ifelodun", "Ila", "Ilesha East", "Ilesha West", "Irepodun", "Irewole", "Isokan", "Iwo", "Obokun", "Odo-Otin", "Ola-Oluwa", "Olorunda", "Oriade", "Orolu", "Osogbo"],
            oyo : ["Afijio", "Akinyele", "Atiba", "Atigbo", "Egbeda", "Ibadan Central", "Ibadan North", "Ibadan North West", "Ibadan South East", "Ibadan South West", "Ibarapa Central", "Ibarapa East", "Ibarapa North", "Ido", "Irepo", "Iseyin", "Itesiwaju", "Iwajowa", "Kajola", "Lagelu Ogbomosho North", "Ogbmosho South", "Ogo Oluwa", "Olorunsogo", "Oluyole", "Ona-Ara", "Orelope", "Ori Ire", "Oyo East", "Oyo West", "Saki East", "Saki West", "Surulere"],
            plateau : ["Barikin Ladi", "Bassa", "Bokkos", "Jos East", "Jos North", "Jos South", "Kanam", "Kanke", "Langtang North", "Langtang South", "Mangu", "Mikang", "Pankshin", "Qua'an Pan", "Riyom","Shendam","Wase"],
            rivers : ["Abua/Odual", "Ahoada East", "Ahoada West", "Akuku Toru", "Andoni", "Asari-Toru", "Bonny", "Degema", "Emohua", "Eleme", "Etche", "Gokana", "Ikwerre", "Khana", "Obia/Akpor", "Ogba/Egbema/Ndoni", "Ogu/Bolo", "Okrika", "Omumma", "Opobo/Nkoro", "Oyigbo", "Port-Harcourt", "Tai"],
            sokoto : ["Binji", "Bodinga", "Dange-shnsi", "Gada", "Goronyo", "Gudu", "Gawabawa", "Illela", "Isa", "Kware", "kebbe", "Rabah", "Sabon birni", "Shagari", "Silame", "Sokoto North", "Sokoto South", "Tambuwal", "Tqngaza", "Tureta", "Wamako", "Wurno", "Yabo"],
            taraba : ["Ardo-kola", "Bali", "Donga", "Gashaka", "Cassol", "Ibi", "Jalingo", "Karin-Lamido", "Kurmi", "Lau", "Sardauna", "Takum", "Ussa", "Wukari", "Yorro", "Zing"],
            yobe : ["Bade", "Bursari", "Damaturu", "Fika", "Fune", "Geidam","Gujba", "Gulani", "Jakusko", "Karasuwa", "Karawa", "Machina", "Nangere", "Nguru Potiskum", "Tarmua", "Yunusari", "Yusufari"],
            zamfara : ["Anka", "Bakura", "Birnin Magaji", "Bukkuyum", "Bungudu", "Gummi", "Gusau", "Kaura", "Namoda", "Maradun", "Maru", "Shinkafi", "Talata Mafara", "Tsafe", "Zurmi"]
        };
        var lgs = new Array();
        var data = [{id:'abia', text:'Abia'},{id:'adamawa', text:'Adamawa'},{id:'akwa_ibom', text:'Akwa_ibom'},{id:'anambra', text:'Anambra'}, {id:'bauchi', text:'Bauchi'}, {id:'bayelsa', text:'Bayelsa'},{id:'benue', text:'Benue'},{id:'borno', text:'Borno'},{id:'cross_river', text:'Cross_river'},{id:'delta', text:'Delta'},{id:'ebonyi', text:'Ebonyi'},{id:'edo', text:'Edo'},{id:'ekiti', text:'Ekiti'},{id:'enugu', text:'Enugu'},{id:'gombe', text:'Gombe'},{id:'fct', text:'Fct'},{id:'imo', text:'Imo'},{id:'jigawa', text:'Jigawa'},{id:'kaduna', text:'Kaduna'},{id:'kano', text:'Kano'},{id:'kastina', text:'Kastina'},{id:'kebbi', text:'Kebbi'},{id:'kogi', text:'Kogi'},{id:'kwara', text:'kwara'},{id:'lagos', text:'Lagos'},{id:'nasarawa', text:'Nasarawa'},{id:'niger', text:'Niger'},{id:'ogun', text:'Ogun'},{id:'ondo', text:'Ondo'},{id:'osun', text:'Osun'},{id:'oyo', text:'Oyo'},{id:'plateau', text:'Plateau'},{id:'rivers', text:'Rivers'},{id:'sokoto', text:'Sokoto'},{id:'tarafa', text:'Tarafa'},{id:'yobe', text:'Yobe'},{id:'zamfara', text:'Zamfara'}]
        $.each(stateArea,function(key, value){
            for(var i=0; i < value.length; i++)
                lgs.push(value[i].replace(/\s+/g, '-'));
        });
        $('#s-state').select2({
            data:data,
            placeholder: 'Select State'
        });
        $('#s-lg').select2({
            placeholder: 'Select Local Government'
        });


        //load search bar data
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/search/get-data',
            success: function(data){
                $.each(data['area'], function(i, el){
                    if($.inArray(el, lgs) === -1) lgs.push(el);
                });

                for(var i=0; i < data['name'].length; i++){
                    lgs.push(data['name'][i]);
                }
                $('#search_page_search').select2({
                    data:lgs,
                    placeholder: "Search by Local Government (e.g Lagos-Mainland) , by School Name (e.g Queens College), by Area (e.g Yaba)"
                });
            }
        });


        /* Update lg Dropdown */
        $(document).on('change','#s-state', function(){
            var mod = "";
            if($(this).attr('data-type') == "mod"){
                mod = "-mod";
            }
            var state = $(this).val();
            $("#s-state option[value='"+state+"']").attr("selected", "selected");
            if(state != ""){
                var area = stateArea[state];

                $('#s-lg').select2({
                    placeholder: 'Select Local Government'
                });
                $("#s-lg"+mod).html("<option value=''>Select lg</option>");
                //$("#area-dropdown"+mod).append('<option value="">Select Area</option>');
                for(var i = 0; i < area.length; i++){
                    $("#s-lg"+mod).append('<option value='+ area[i].replace(/\s+/g, '-') +'>'+ area[i].replace(/\s+/g, '-') +'</option>');
                }
            }
        });

        $('#s-area').select2({
            placeholder: 'Select an Area',
        });

        $(document).on('change', '#s-lg', function(){
            var lg = $(this).val();
            var arr_area = [];
            var new_area = []
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/search/get_area',
                data: {'lg' : lg},
                success: function(data){
                    data['area'].forEach(function(item){
                        arr_area.push(item['area']);
                    });
                    $.each(arr_area, function(i, el){
                        if($.inArray(el, new_area) === -1) new_area.push(el);
                    });
                    $('#s-area').select2({
                        placeholder: 'Select an Area',
                        data:new_area
                    });
                },
                error: function(data){

                }
            });
        });


        var data_lg = [{id:'preschool', text:"Preschool"}, {id:'primary', text:'Primary School'},
            {id:'secondary', text:'Secondary School'}, {id:'tertiary', text:'Tertiary'},{id:'vocation', text:'Vocational'}];

        $('#s-type').select2({
            placeholder: 'Select school type',
            data: data_lg
        });



        $('.opt').tooltipster({
            position: 'top',
            theme: 'tooltipster-shadow',
            content: $('<p style="height: 50px; width: 150px">Please select an area in the local government you choose.Thank you.</p>')
        });

        //set localstorage for compare count
        localStorage.setItem('compareCount', 0)


        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
            '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
            '<div class="progress progress-striped active">' +
            '<div class="progress-bar" style="width: 100%;"></div>' +
            '</div>' +
            '</div>';

        var $modal = $('#ajax-modal');
        $('.map').on('click', function(event){
            event.preventDefault();
            var lat = $(this).attr('data-address-lat');
            var lng = $(this).attr('data-address-lng');
            $('body').modalmanager('loading');
            setTimeout(function(){
                $modal.modal();
                var map = new GMaps({
                    div: '#ajax-modal',
                    lat:    lat,
                    lng:    lng
                });

                map.addMarker({
                    lat:    lat,
                    lng:    lng
                });
            }, 1000);

        });

        var $btn = $('.compare');
        var sch_count = 0;
        var school_id = [];
        var $modal_new = $('#ajax_modal_compare');
        var list = $('.school-data-list');

        //get base url
        var pathArray = location.href.split( '/' );
        var protocol = pathArray[0];
        var host = pathArray[2];
        var base_url = protocol + '//' + host;



        $btn.on('click', function(e){
            e.preventDefault();
            var $this = $(this);
            //if local storage var is == 1
            if( Number(localStorage.getItem('compareCount')) == 0){
                if(!$this.hasClass('reduce')){
                    //push the current school's id
                    //into the school_id array
                    school_id.push($this.attr('data-id'));
                    count = localStorage.getItem('compareCount');
                    new_count  = Number(count) + 1;
                    sch_count = new_count;
                    localStorage.setItem('compareCount', new_count);
                    $this.addClass('reduce').text('').append('<i class="fa fa-check pull-left"></i>');
                    var text = 'Compare now ('+sch_count+'/4)';
                    $this.nextAll().text(text);
                }
                else{
                    //if a school is to be unpicked
                    //the schools id showed be removed from the id array
                    var index = school_id.indexOf($this.attr('data-id'));
                    if(index > -1){
                        school_id.splice(index, 1);
                    }
                    console.log(school_id);
                    var count = localStorage.getItem('compareCount');
                    var new_count  = Number(count) - 1;
                    localStorage.setItem('compareCount', new_count);
                    $this.removeClass('reduce').text('compare').append('<i class="fa fa-check pull-left"></i>');
                    $this.nextAll().text('');
                }
            }
            //if local storage var is less than 4
            else if(Number(localStorage.getItem('compareCount')) >= 1 && Number(localStorage.getItem('compareCount')) < 4  ) {
                if(!$this.hasClass('reduce')){
                    //push the current school's id
                    //into the school_id array
                    school_id.push($this.attr('data-id'));
                    count = localStorage.getItem('compareCount');
                    new_count  = Number(count) + 1;
                    sch_count = new_count;
                    localStorage.setItem('compareCount', new_count);
                    $this.addClass('reduce').text('').append('<i class="fa fa-check pull-left"></i>');
                    var text = "<a href='#' class='compare-trigger'><strong>Compare now</strong>("+sch_count+"'/4)</a>"
                    $this.nextAll().html(text);
                    var $cmpr = $('.compare-trigger');
                    $cmpr.on('click', function(e){
                        e.preventDefault();
                        console.log('here');
                        window.location.replace(base_url+"/search/compare?ids="+school_id);
                    })
                }
                else{
                    //if a school is to be unpicked
                    //the schools id showed be removed from the id array
                    var index = school_id.indexOf($this.attr('data-id'));
                    if(index > -1){
                        school_id.splice(index, 1);
                    }
                    console.log(school_id);
                    var count = localStorage.getItem('compareCount');
                    var new_count  = Number(count) - 1;
                    localStorage.setItem('compareCount', new_count);
                    $this.removeClass('reduce').text('compare').append('<i class="fa fa-check pull-left"></i>');
                    $this.nextAll().text('');
                }
            }
            //if school is to be unpicked
            //and count is equal to 4
            else if(Number(localStorage.getItem('compareCount')) == 4 && ($this.hasClass('reduce'))){
                //if a school is to be unpicked
                //the schools id showed be removed from the id array
                var index = school_id.indexOf($this.attr('data-id'));
                if(index > -1){
                    school_id.splice(index, 1);
                }
                console.log(school_id);
                var count = localStorage.getItem('compareCount');
                var new_count  = Number(count) - 1;
                localStorage.setItem('compareCount', new_count);
                $this.removeClass('reduce').text('compare').append('<i class="fa fa-check pull-left"></i>');
                $this.nextAll().text('');
            }
            //when localstorage = 4, and a new button is clicked
            //show user alert to compare the schools chosen
            else{
                var compare = $(this).parent().parent().parent().parent().parent().find('#compare_success');
                console.log(compare);
                $(compare).html("<div class='alert alert-danger fade in move'>");
                $('.alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
                $('.alert-danger').append("<strong>You've already selected 4 schools to compare.  <a href='#' class='compare-trigger'>Compare schools.</a></strong>");
                $('.alert-danger').append('</div>');
                console.log(school_id);
                //When compare schools is clicked
                var $cmpr = $('.compare-trigger');
                $cmpr.on('click', function(e){
                    e.preventDefault();
                    console.log('here');
                    window.location.replace(base_url+"/search/compare?ids="+school_id);
                })
            }
        });

        //Ion SLider
        $("#range_2").ionRangeSlider({
        });
    });
