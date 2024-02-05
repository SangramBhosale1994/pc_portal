<?php

foreach($pages->get("name=universal-companies")->children() as $company_page){
print_r($company_page->name);
    	echo "<br>";
     $admin_email = $company_page->admin_email;
echo $admin_email;
    	echo "<br>";
    $admin_profile=$pages->get("name=universal-profiles")->child("email=".$admin_email);
echo $admin_profile;
    	echo "<br>";
    
     $company_page->company_profile_id=$admin_profile->id;
    //  echo $company_page->company_profile_id;
    
        $company_page->of(false);
		$company_page->save();
		
     $admin_profile->company_page_id=$company_page->id;
     //echo "==================================";
echo $admin_profile->company_page_id;
    
        $admin_profile->of(false);
		$admin_profile->save();
		echo "<hr>";
}
?>