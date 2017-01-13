/**
 * Created by OluwadamilolaAdebayo on 9/6/15.
 */
$(document).ready(function () {
    //Initialize Select2 Elements
    $(".select2").select2();



    $('#state-dropdown').select2({
        placeholder: "Select a state"
    });

    $('#area-dropdown').select2({
        placeholder: "Select a LG"
    });

    $('#area').select2({
        placeholder: "Select an area"
    });

    $('.extra').select2({
        placeholder: "Select one or more"
    });


    //making checkbox be in groups
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

    //if the private checkbox is clicked
    //religion div should should be visible
    $('#private').on('click', function(){
        var $show = $(this);
        if($show.is(":checked")){
            $('.religion').show();
        }
    });

    //if religion div is visible
    //and public checkbos is clicked
    //religion should be hidden
    $('#public').on('click', function(){
        var $show = $(this);
        var rel = $('.religion');
        if(rel.is(":visible") && $('.rel-type').is(":visible")){
            rel.hide();
            $('.rel-type').hide();
        }
    });


    //if religious box is clicked
    //show religion type
    $('#religious').on('click', function(){
        var $show = $(this);
        if($show.is(":checked")){
            $('.rel-type').show();
        }
    });

    //if rel-type div is visible
    //and non-religious box is clicked
    //rel-type should hide
    $('#non-religious').on('click', function(){
        var $show = $(this);
        if($show.is(":checked")){
            $('.rel-type').hide();
        }
    });


    //if millitary box os clicked
    //military-type is shown
    $('#militaryo').on('click', function(){
        var $show = $(this);
        if($show.is(":checked")){
            $('.military-type').show();
        }
    });


    $('#nmo').on('click', function(){
        var $show = $(this);
        if($show.is(":checked")){
            $('.military-type').hide();
        }
    });

    //if value of schooltype is preschool
    //show preschool
    if($('.sch-typ').val() == 'preschool'){
        $('.preschool').show();
    }

    //if value of schooltype is tertiary
    //show tertiary
    if($('.sch-typ').val() == 'tertiary'){
        $('.tertiary').show();
    }



    //Initialize the tooltip
    $('.explain').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 50px; width: 150px">Please just type in your Address number and street, e.g No 34 Bolaji Street</p>')
    });

    $('.coed').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">College of Education</p>')
    });

    $('.mo').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">Military Owned</p>')
    });

    $('.nmo').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">Non Military Owned</p>')
    });

    $('.fmp').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">Full Military Program</p>')
    });

    $('.ecmp').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">Extra Curricular Millitary Program</p>')
    });

    $('.nmp').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 30px; width: 80px">No Military Program</p>')
    });

    $('.sports-tool').tooltipster({
        position: 'top',
        theme: 'tooltipster-shadow',
        content: $('<p style="height: 70px; width: 100px">Please choose one or more.Thank you.</p>')
    });

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});


    $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
        '<div class="loading-spinner" style="width: 400px; margin-left: -200px;">' +
        '<div class="progress progress-striped active">' +
        '<div class="progress-bar" style="width: 100%;"></div>' +
        '</div>' +
        '</div>';
    var $modal = $('#ajax-modal');
    //Ajax post to submit basic info
    $('.basic-info').on('submit', function(event){
        event.preventDefault();

        //show a spinner here
        $('body').modalmanager('loading');
        form_data = $(this).serialize();

        //Hide button, disable form text
        $("input[type='text'], input[type='email'], .select2").css({
            'border':'none'
        });
        $("input[type='text'], .select2").prop('disabled', true).addClass('remove-input');
        $('.btn-save').hide();
        $('.form-edit').show();
        $('.select2-container--default .select2-selection--single .select2-selection__arrow b').hide();


        $.ajax({
            type: "POST",
            dataType:"json",
            url: '/school/basic_info',
            data: form_data,
            success: function(data){
                for(var key in data){
                    if(key == 'error_msg'){
                        setTimeout(function(){
                            $modal.load('/error.html', '', function(){
                                $modal.modal();
                                $('#input_error').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'save'){
                        setTimeout(function(){
                            $modal.load('/success.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }else if(key == 'map'){
                        setTimeout(function(){
                            $modal.load('/warning.html', '', function(){
                                $modal.modal();
                                $('#input_success').append("<li>"+data[key]+"</li>");
                            });
                        }, 1000);
                    }
                }
            }
        });
    });


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
            lgs.push(value[i]);
    });
    var data = [{id:'abia', text:'Abia'},{id:'adamawa', text:'Adamawa'},{id:'akwa_ibom', text:'Akwa_ibom'},{id:'anambra', text:'Anambra'}, {id:'bauchi', text:'Bauchi'}, {id:'bayelsa', text:'Bayelsa'},{id:'benue', text:'Benue'},{id:'borno', text:'Borno'},{id:'cross_river', text:'Cross_river'},{id:'delta', text:'Delta'},{id:'ebonyi', text:'Ebonyi'},{id:'edo', text:'Edo'},{id:'ekiti', text:'Ekiti'},{id:'enugu', text:'Enugu'},{id:'gombe', text:'Gombe'},{id:'fct', text:'Fct'},{id:'imo', text:'Imo'},{id:'jigawa', text:'Jigawa'},{id:'kaduna', text:'Kaduna'},{id:'kano', text:'Kano'},{id:'kastina', text:'Kastina'},{id:'kebbi', text:'Kebbi'},{id:'kogi', text:'Kogi'},{id:'kwara', text:'kwara'},{id:'lagos', text:'Lagos'},{id:'nasarawa', text:'Nasarawa'},{id:'niger', text:'Niger'},{id:'ogun', text:'Ogun'},{id:'ondo', text:'Ondo'},{id:'osun', text:'Osun'},{id:'oyo', text:'Oyo'},{id:'plateau', text:'Plateau'},{id:'rivers', text:'Rivers'},{id:'sokoto', text:'Sokoto'},{id:'tarafa', text:'Tarafa'},{id:'yobe', text:'Yobe'},{id:'zamfara', text:'Zamfara'}]
    var sport = [{id:'swimming', text:'Swimming'},{id:'karate', text:'karate'},{id:'taekwondo', text:'Taekwondo'}, {id:'chess', text:'Chess'},
        {id:'scrabble', text:'scrabble'},{id:'Lawn-Tennis', text:'Lawn-Tennis'},{id:'basketball', text:'Basketball'},{id:'table-temmis', text:'Table-Tenis'}, {id:'volleyball', text:'Volleyball'}, {id:'cricket', text:'cricket'}]
    var clubs = [{id:'Literary/Debating Society', text: 'Literary/Debating Society'}, {id:'boys-scout', text:'Boys-Scout'}, {id:'girls-guide', text:'Girls-Guide'},
        {id:'red-cross', text:'Red-Cross'}, {id:'man-o-war', text:'Man-O-War'}, {id:'military-cadet', text:'Military-Cadet'}]

    $('#state-dropdown').select2({
        data:data
    });

    /* Update Area Dropdown */
    $(document).on('change','#state-dropdown', function(){

        var mod = "";
        if($(this).attr('data-type') == "mod"){
            mod = "-mod";
        }
        var state = $(this).val();
        $("#state-dropdown option[value='"+state+"']").attr("selected", "selected");
        if(state != ""){
            var area = stateArea[state];

            $("#area-dropdown"+mod).html("<option value=''>Select Area</option>");
            //$("#area-dropdown"+mod).append('<option value="">Select Area</option>');
            for(var i = 0; i < area.length; i++){

                $("#area-dropdown"+mod).append('<option value='+ area[i].replace(/\s+/g, '-') +'>'+ area[i].replace(/\s+/g, '-') +'</option>');
            }
        }
    });


    //Get Unread Image for display
    $.ajax({
        type: "POST",
        dataType:"json",
        url: '/school/unread_messages',
        data: {'TEST':'TEST'},
        success: function(data){
            var dt = data.data
            console.log(data.data);
            var ct = dt.length;
            $('.msg-count').text(ct);
            $('.sidebar_msg_count').text(ct);
            if($('.inbox-msg-count')){
                $('.inbox-msg-count').text(ct);
            }
            if(dt.length > 0){
                dt.forEach(function(item){
                    console.log(item);
                    var url = "/school/message/"+item.id;
                    $('.msg_reader').append(
                        '<li><ul class="menu"><li class="pull-left"><a href='+ url +'><h4>'+ item.sender_identity +'</h4>'
                        + "<p>"+ item.subject  +"</p></a></li></ul></li>"
                    );
                })
            }
        }
    });
});