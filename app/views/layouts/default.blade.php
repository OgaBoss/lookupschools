<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- Start of edurepo Zendesk Widget script -->
<script>/*<![CDATA[*/window.zEmbed||function(e,t){var n,o,d,i,s,a=[],r=document.createElement("iframe");window.zEmbed=function(){a.push(arguments)},window.zE=window.zE||window.zEmbed,r.src="javascript:false",r.title="",r.role="presentation",(r.frameElement||r).style.cssText="display: none",d=document.getElementsByTagName("script"),d=d[d.length-1],d.parentNode.insertBefore(r,d),i=r.contentWindow,s=i.document;try{o=s}catch(c){n=document.domain,r.src='javascript:var d=document.open();d.domain="'+n+'";void(0);',o=s}o.open()._l=function(){var o=this.createElement("script");n&&(this.domain=n),o.id="js-iframe-async",o.src=e,this.t=+new Date,this.zendeskHost=t,this.zEQueue=a,this.body.appendChild(o)},o.write('<body onload="document._l();">'),o.close()}("https://assets.zendesk.com/embeddable_framework/main.js","edurepo.zendesk.com");/*]]>*/</script>
<!-- End of edurepo Zendesk Widget script -->
<head>
    @include('includes.head')
</head>

<body>

    <div id="preloader">
        <div id="status"></div>
    </div>
    <header>
        @include('includes.header')
    </header>
    <div class="wrapper">
        {{ Toastr::render() }}
        @yield('content')

        <footer>
            @include('includes.footer')
        </footer>
    </div>
    <div id="ajax-modal" class="modal fade col-md-4" tabindex="-1" style="display: none;">
    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    {{ HTML::script('js/bootstrap-modalmanager.js'); }}
    {{ HTML::script('js/bootstrap-modal.js'); }}
    {{ HTML::script('js/select2.full.js'); }}
    <script src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
    <script src="js/new_js/jquery.scrollTo.min.js"></script>
    <script src="js/new_js/jquery.nav.min.js"></script>
    <script src="js/new_js/appear.js"></script>
    <script src="js/new_js/owl.carousel.js"></script>
    <script src="js/new_js/jquery.mixitup.js"></script>
    <script src="js/new_js/jquery.magnific-popup.min.js"></script>
    <script src="js/new_js/custom.js"></script>
    <script src="js/new_js/jqBootstrapValidation.js"></script>
    {{--{{ HTML::script('plugins/owl_2/owl.carousel.js'); }}--}}

    {{--<script src="js/new_js/contact_me.js"></script>--}}

    <script>

        $(document).ready(function() {
            var $modal = $('#ajax-modal');

            //On click of video image play video modal
            $('.modal-ad').on('click', function(e){
                var $this = $(this);
                e.preventDefault();
                $modal.load('/ads.html', '', function () {
                    $modal.modal();
                    $('.modal-title').text($this.attr('data-school-name'))
                    var src = '//www.youtube.com/embed/'+$this.attr('data-v');
                    $('.iframe-player').attr('src',src);
                });
            });

//            $.ajax({
//                type: "POST",
//                dataType:"json",
//                url: '/modal_ad',
//                data: { 'ads': 'ads' },
//                success: function(data){
//                    for(var key in data){
//                        if(key == 'save'){
//                            $modal.load('/ads.html', '', function () {
//                                $modal.modal();
//                            });
//                        }
//                    }
//                },
//                error: function(data){
//
//                }
//            });

            $('.owl_carousel_2').slick({
                infinite: true,
                slidesToShow: 8,
                slidesToScroll: 8
            });
            $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                    '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
                    '<div class="progress progress-striped active">' +
                    '<div class="progress-bar" style="width: 100%;"></div>' +
                    '</div>' +
                    '</div>';
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
            $.each(stateArea,function(key, value){
                for(var i=0; i < value.length; i++)
                    lgs.push(value[i].replace(/\s+/g, '-'));
            });

            var data = [{id:'abia', text:'Abia'},{id:'adamawa', text:'Adamawa'},{id:'akwa_ibom', text:'Akwa_ibom'},{id:'anambra', text:'Anambra'}, {id:'bauchi', text:'Bauchi'}, {id:'bayelsa', text:'Bayelsa'},{id:'benue', text:'Benue'},{id:'borno', text:'Borno'},{id:'cross_river', text:'Cross_river'},{id:'delta', text:'Delta'},{id:'ebonyi', text:'Ebonyi'},{id:'edo', text:'Edo'},{id:'ekiti', text:'Ekiti'},{id:'enugu', text:'Enugu'},{id:'gombe', text:'Gombe'},{id:'fct', text:'Fct'},{id:'imo', text:'Imo'},{id:'jigawa', text:'Jigawa'},{id:'kaduna', text:'Kaduna'},{id:'kano', text:'Kano'},{id:'kastina', text:'Kastina'},{id:'kebbi', text:'Kebbi'},{id:'kogi', text:'Kogi'},{id:'kwara', text:'kwara'},{id:'lagos', text:'Lagos'},{id:'nasarawa', text:'Nasarawa'},{id:'niger', text:'Niger'},{id:'ogun', text:'Ogun'},{id:'ondo', text:'Ondo'},{id:'osun', text:'Osun'},{id:'oyo', text:'Oyo'},{id:'plateau', text:'Plateau'},{id:'rivers', text:'Rivers'},{id:'sokoto', text:'Sokoto'},{id:'tarafa', text:'Tarafa'},{id:'yobe', text:'Yobe'},{id:'zamfara', text:'Zamfara'}]

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
                    $('#home-dropdown').select2({
                        data:lgs,
                        placeholder: "Search by Local Government (e.g Lagos-Mainland) , by School Name (e.g Queens College), by Area (e.g Yaba)"
                    });
                }
            });

            function ajax(data, $modal) {
                for (var key in data) {
                    if (key == 'error_msg') {
                        setTimeout(function () {
                            $modal.load('/error.html', '', function () {
                                $modal.modal();
                                $('#input_error').append("<li>" + data[key] + "</li>");
                            });
                        }, 1000);
                    } else if (key == 'save') {
                        setTimeout(function () {
                            $modal.load('/success.html', '', function () {
                                $modal.modal();
                                $('#input_success').append("<li>" + data[key] + "</li>");
                            });
                        }, 1000);
                    } else if (key == 'update') {
                        setTimeout(function () {
                            $modal.load('/success.html', '', function () {
                                $modal.modal();
                                $('#input_success').append("<li>" + data[key] + "</li>");
                            });
                        }, 1000);
                    }
                }
            }
            $('.help').on('submit', function(e){
                e.preventDefault();
                $('body').modalmanager('loading');
                var form_data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    dataType:"json",
                    url: '/send_email',
                    data: form_data,
                    success: function(data){
                        ajax(data, $modal);
                    },
                    error: function(data){

                    }
                })
            });
        });

        (function() {
            [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
                new SelectFx(el);
            } );
        })();
    </script>
</body>
</html>

