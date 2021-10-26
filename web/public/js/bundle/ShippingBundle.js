function drawSaleDetail(data, parameter_1)
{
    var longitud = data.length;

    for (i = 0; i < longitud; i++)
    {
        var sale_id_1 = data[i]["sale_id_1"];
        var customer_id_1 = data[i].customer_id_1;
        var sale_date_1 = data[i].sale_date_1;
        var sale_total_1 = data[i].sale_total_1;
        var sale_status_1 = data[i].sale_status_1;
        var saleDetail_id_1 = data[i].saleDetail_id_1;
        var product_id_1 = data[i]["product_id_1"];
        var saleDetail_amount_1 = data[i].saleDetail_amount_1;
        var product_name_1 = data[i].product_name_1;
        var product_description_1 = data[i].product_description_1;
        var product_image_1 = data[i].product_image_1;

        var store_branch_location_1 = data[i].store_branch_location_1;
        var store_branch_id_1 = data[i].store_branch_id_1;
        var store_branch_name_1 = data[i].store_branch_name_1;
        var store_branch_telephone_1 = data[i].store_branch_telephone_1;
        var store_branch_cellphone_1 = data[i].store_branch_cellphone_1;
        var store_branch_aditional_information_1 = data[i].store_branch_aditional_information_1;


        var commercial_store_id = data[i].commercial_store_id;
        var commercial_store_name = data[i].commercial_store_name;
        var commercial_store_tin = data[i].commercial_store_tin;
        var location_origin = data[i].location_origin;

        var customer_branch_location_1 = data[i].customer_branch_location_1;
        var customer_branch_id_1 = data[i].customer_branch_id_1;
        var customer_branch_name_1 = data[i].customer_branch_name_1;
        var customer_branch_telephone_1 = data[i].customer_branch_telephone_1;
        var customer_branch_cellphone_1 = data[i].customer_branch_cellphone_1;
        var customer_branch_aditional_information_1 = data[i].customer_branch_aditional_information_1;


        var commercial_customer_id = data[i].commercial_customer_id;
        var commercial_customer_name = data[i].commercial_customer_name;
        var commercial_customer_tin = data[i].commercial_customer_tin;
        var location_destiny = data[i].location_destiny;


//            alert(
//"\nsale_id_1 : " + sale_id_1 + " " + 
//"\ncustomer_id_1 : " + customer_id_1 + " " + 
//"\nsale_date_1 : " + sale_date_1 + " " + 
//"\nsale_total_1 : " + sale_total_1 + " " + 
//"\nsale_status_1 : " + sale_status_1 + " " + 
//"\nsaleDetail_id_1 : " + saleDetail_id_1 + " " + 
//"\nproduct_id_1 : " + product_id_1 + " " + 
//"\nsaleDetail_amount_1 : " + saleDetail_amount_1 + " " + 
//"\nproduct_name_1 : " + product_name_1 + " " + 
//"\nproduct_description_1 : " + product_description_1 + " " + 
//"\nproduct_image_1 : " + product_image_1 + " " + 
//"\nstore_branch_location_1 : " + store_branch_location_1 + " " + 
//"\nstore_branch_id_1 : " + store_branch_id_1 + " " + 
//"\nstore_branch_name_1 : " + store_branch_name_1 + " " + 
//"\nstore_branch_telephone_1 : " + store_branch_telephone_1 + " " + 
//"\nstore_branch_cellphone_1 : " + store_branch_cellphone_1 + " " + 
//"\nstore_branch_aditional_information_1 : " + store_branch_aditional_information_1 + " " + 
//"\ncommercial_store_id : " + commercial_store_id + " " + 
//"\ncommercial_store_name : " + commercial_store_name + " " + 
//"\ncommercial_store_tin : " + commercial_store_tin + " " + 
//"\nlocation_origin : " + location_origin + " " + 
//"\ncustomer_branch_location_1 : " + customer_branch_location_1 + " " + 
//"\ncustomer_branch_id_1 : " + customer_branch_id_1 + " " + 
//"\ncustomer_branch_name_1 : " + customer_branch_name_1 + " " + 
//"\ncustomer_branch_telephone_1 : " + customer_branch_telephone_1 + " " + 
//"\ncustomer_branch_cellphone_1 : " + customer_branch_cellphone_1 + " " + 
//"\ncustomer_branch_aditional_information_1 : " + customer_branch_aditional_information_1 + " " + 
//"\ncommercial_customer_id : " + commercial_customer_id + " " + 
//"\ncommercial_customer_name : " + commercial_customer_name + " " + 
//"\ncommercial_customer_tin : " + commercial_customer_tin + " " + 
//"\nlocation_destiny : " + location_destiny + " "
//            );





        if (parameter_1 === "waiting_shipping")
        {
            var shipment_id_1 = data[i].shipment_id_1;
            var shipment_setUpDate_1 = data[i].shipment_setUpDate_1;
            var amountRecords = data[i].amountRecords;

//                alert("\nshipment_id_1 "+shipment_id_1+
//                      "\namountRecords "+amountRecords+
//                      "\nshipment_setUpDate_1 "+shipment_setUpDate_1);

            drawProduct_List(
                saleDetail_id_1, 
                shipment_id_1, 
                shipment_setUpDate_1, 
                commercial_store_name + " " + commercial_customer_name, 
                data[i], 
                product_image_1, 
                location_origin + " " + location_destiny, 
                "shipping", 
                "user", 
                parameter_1 
            );
        } else if (parameter_1 === "waiting_routes")
        {
            drawProduct_List(
                saleDetail_id_1, 
                saleDetail_id_1, 
                sale_date_1, 
                commercial_store_name + " " + commercial_customer_name, 
                data[i], 
                product_image_1, 
                location_origin + " " + location_destiny, 
                "reach", 
                "user", 
                parameter_1 
            );
        } else
        {
//                drawProduct_List(
//                    saleDetail_id_1, 
//                    product_id_1, 
//                    sale_date_1, 
//                    0, 
//                    product_description_1, 
//                    product_image_1, 
//                    0, 
//                    "queryType", 
//                    saleDetail_amount_1, 
//                    parameter_1 
//                );
        }
    }
}