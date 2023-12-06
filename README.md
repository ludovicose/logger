# Logger Library with Request Sequence (uuid)

## Overview

This PHP library enhances logging capabilities by incorporating a unique identifier (UUID) into each log entry,
specifically tied to individual requests. The inclusion of UUIDs facilitates efficient log retrieval, allowing users to
trace data associated with a particular request from the beginning to the end of the PHP script execution.

## Features

### Request UUID Logging

The library assigns a UUID to each log entry, offering a convenient means of searching and analyzing logs related to a
specific request. This feature proves invaluable for troubleshooting and comprehending the flow of requests within your
PHP application.

### Middleware Group Logging

If a middleware group is specified in the configuration file, the library logs requests and user responses associated
with that group.

Example configuration:

```php
'middleware_groups' => [
    'web',
    'api'
],
```

### HTTP Request Logging

Enabling HTTP request logging captures details about communication between servers, including information about incoming
and outgoing HTTP requests.

```php
'enable_http_log' => true
```

### Eloquent Event Logging

The library can log all Eloquent model events, including save, edit, and other related activities. This feature is
useful for monitoring changes to your application's data.

```php
'enable_eloquent_log' => true,
```

### Database Query Logging

Enabling database query logging helps keep track of all queries made to the database, aiding in performance optimization
and debugging database-related issues.

```php
'enable_query_log' => true,
```

## Installation

1. ##### Install via Composer:

```bash
composer require ludovicose/logger
```

2. ##### Configuration:

Copy the configuration file to your project and customize it according to your requirements.

```bash
php artisan vendor:publish --provider="Ludovicose\Logger\PackageServiceProvider" --tag="config"

```

3. #### Usage:

Once installed and configured, the logger will automatically start capturing logs based on your specified settings.
