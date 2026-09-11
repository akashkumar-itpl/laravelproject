<script>

    getOurServicesData();
    getInvestmentLegendsData();

    // $("body").on('change', '#sectionOneType', function(e) {
    //     let sectionType = $(this).val();
    //     getSectionOneData(sectionType);
    // });

    function getInvestmentLegendsData() {

        selectedData = '<?php echo json_encode(unserialize(isset($allData['investmentLegends'])?$allData['investmentLegends']: '')); ?>';

        $.ajax({
            type: "GET",
            url: "{{ url('admin/InvestmentLegendsList') }}",
            data: {
                "homeItems": JSON.parse(selectedData)
            },
            beforeSend: function() {
                $("#loaderImage").show();
            },
            complete: function() {
                $("#loaderImage").hide();
            },
            success: function(res) {
                // console.log(res);
                // alert(res);
                if (res) {
                    $("#investmentLegends").empty();
                    $("#investmentLegends").append(res);

                } else {
                    $("#investmentLegends").empty();
                }
            }

        });
    }
    function getOurServicesData() {

        selectedData = '<?php echo json_encode(unserialize(isset($allData['sectionSevenItems'])?$allData['sectionSevenItems']: '')); ?>';

        $.ajax({
            type: "GET",
            url: "{{ url('admin/OurServicesList') }}",
            data: {
                "homeItems": JSON.parse(selectedData)
            },
            beforeSend: function() {
                $("#loaderImage").show();
            },
            complete: function() {
                $("#loaderImage").hide();
            },
            success: function(res) {
                // console.log(res);
                // alert(res);
                if (res) {
                    $("#sectionSevenItems").empty();
                    $("#sectionSevenItems").append(res);

                } else {
                    $("#sectionSevenItems").empty();
                }
            }

        });
    }
</script>
