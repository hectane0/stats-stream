# StatsStream


## Supporting services: 
  * YouTube
  * Twitch
  * Smashcast
  

## Usage:

* Download library to your project
* Put your API keys in `Config/Paramerets.php`
* Create statistics object and work with its functions:

```php
$stats = new \StatsStream\Application\StatisticsService();
$result = $stats->findUniqueVideosOnTwitch();
print_r($result);
```

### Want to download a result as spreadsheet?
No problem: Use SpreadsheetService:

```php
$result = $stats->findUniqueVideosOnTwitch();
$xml = new \StatsStream\Application\SpreadsheetService();
$xml->download($result);
```

### Want to extend library with new streaming service? 
Easy-peasy - just bring API client into existence in `Infrastructure/ApiClient/`, then create new service directory in `Domain/Provider/` and implement as many providers as you need.

### Want to extend library with new functionality?
Place them in `Application/StatisticsService/StatisticsService.php`
