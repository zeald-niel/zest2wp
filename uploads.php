<?php
require('vendor/autoload.php');
use League\Csv\Reader;
use League\Csv\Writer;

$valid_extensions = array('csv', 'tsv'); // valid extensions
$path = ''; // upload directory

if( $_FILES['csv'])
{
    $csv = $_FILES['csv']['name'];
    $tmp = $_FILES['csv']['tmp_name'];
    $output = 'processed-'.$csv;

    // get uploaded file's extension
    $ext = strtolower(pathinfo($csv, PATHINFO_EXTENSION));

    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 

        if(move_uploaded_file($tmp,$csv)) 
        {
            $zest = Reader::createFromPath($csv, 'r');
            $zest->setHeaderOffset(0);
            $header = $zest->getHeader();
            $records = $zest->getRecords();

            //load the CSV document from a string
            $converted = Writer::createFromPath($output, 'w+');
            
            //category1, category2, category3
            $converted->insertOne([
                'sku',
                'title',
                'description',
                'detaileddescription',
                'price',
                'quantity',
                'productimage',
                'largeimage',
                'wholesaleprice',
                'status',
                'brand',
                'material',
                'categoryhier1',
                'categoryhier2',
                'categoryhier3',
                'categoryhier4'
            ]);
            foreach ($records as $record) {
                $status = 'publish'; 
                if( $record[$header[9]] > 0 ) //Inactive
                {
                    $status = 'pending'; 
                }
                $categories = preg_split("/\r\n|\n|\r/", $record[$header[36]]); //Category
                $subcategories = preg_split("/\r\n|\n|\r/", $record[$header[37]]); //Sub category
                $subx2categories = preg_split("/\r\n|\n|\r/", $record[$header[38]]); //Subx2 category
                $categoryhier = [];
                $separator = '>';
                $loop = 0;
                foreach ($categories as $category) {
                    $temp = '';
                    if( !empty( $category ) ) {
                        $temp = $category;
                    }
                    if( isset( $subcategories[$loop] ) && !empty( $subcategories[$loop] ) && count($subcategories) > $loop  ) {
                        $temp .= $separator.$subcategories[$loop];
                    }
                    if( isset( $subx2categories[$loop] ) && !empty( $subx2categories[$loop] ) && count($subx2categories) > $loop ) {
                        $temp .= $separator.$subx2categories[$loop];
                    }
                    $categoryhier[] = $temp;
                    $loop++;
                }
                $converted->insertOne([
                    $record[$header[0]], //SKU
                    $record[$header[1]], //Title
                    $record[$header[2]], //Description
                    $record[$header[3]], //Detailed Description
                    $record[$header[6]], //Price
                    $record[$header[26]], //Quantity
                    $record[$header[5]], //Product Image
                    $record[$header[10]], //Large Image
                    $record[$header[7]], //Wholesale Price
                    $status, 
                    $record[$header[24]], //Brand
                    $record[$header[25]], //material
                    assignExist($categoryhier[0]), 
                    assignExist($categoryhier[1]), 
                    assignExist($categoryhier[2]), 
                    assignExist($categoryhier[3])
                ]);
            }
        }
        echo $output;
    } 
    else 
    {
        echo 'invalid';
    }
}
function assignExist( $val = '' )
{
    return $val;
}
?>