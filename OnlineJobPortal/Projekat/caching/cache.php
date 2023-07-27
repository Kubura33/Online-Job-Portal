<?php 
require_once 'reading/read_cache_users.php';

require_once 'reading/read_jobs.php';
require_once 'reading/read_ads.php';
function cacheUsersData($usersData, $filePath) {
    $cacheExpiration = time() + 3600; 
   

    $cacheData = array(
        'data' => $usersData,
        'expiration' => $cacheExpiration,
    );

    
    $serializedData = serialize($cacheData);
    file_put_contents($filePath, $serializedData);
}

function getUsersFromCache($filePath)
{
    
    if (file_exists($filePath)) {
        $serializedData = file_get_contents($filePath);
        $cacheData = unserialize($serializedData);

        if ($cacheData['expiration'] >= time()) {
            return $cacheData['data'];
        } else {
            
            unlink($filePath);
        }
    }

    return false;;

}
function getUsers($filePath)
{
    $cachedUsersData = getUsersFromCache($filePath);
    if(!$cachedUsersData)
    {
        $usersData = getUsersFromDatabase();
        cacheUsersData($usersData,$filePath);

    }
    else
    {
        $usersData = $cachedUsersData;
    }
    return $usersData;
}

function getCompanies($filePath)

{
    $cachedUsersData = getUsersFromCache($filePath);
    if(!$cachedUsersData)
    {
        $usersData = getCompaniesFromDatabase();
        cacheUsersData($usersData,$filePath);
    }
    else
    {
        $usersData = $cachedUsersData;
    }
    return $usersData;
}

function getJobs($filePath)
{
 $cached = getUsersFromCache($filePath);
 if(!$cached)
 {
    $jobs = getJobsFromDatabase();
    cacheUsersData($jobs, $filePath);

 }
 else
 {
    $jobs = $cached;
 }
 return $jobs;
}

function getAds($filePath)
{
    $cached = getUsersFromCache($filePath);
 if(!$cached)
 {
    $ads = getAdsFromDatabase();
    cacheUsersData($ads, $filePath);

 }
 else
 {
    $ads = $cached;
 }
 return $ads;
}

?>