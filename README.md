# Documentation


## Run the project

Check if you have already installed all prerequesites to use Laravel. If you didn't installed yet, follow the instructions from [Laravel 11.x Documentation](https://laravel.com/docs/11.x).

### 1. Composer install

After your environment is working, run the following code to install the dependencies.
```bash
composer install
```

### 2. Environment variables

The .env example file is the same to use as default .env, so there's no need to make changes in this file. you can simply type
```bash
cp .env.example .env
```
### 3. Run docker containers

This project uses a simple postgresql database that could be started using docker compose.
Type the following line to execute the containers:
```bash
docker compose up -d
```

### 4. Execute migrations and run the project

To execute the migrations to populate database type the following:
```bash
php artisan migrate
```

After migrations executed you can run the project with
```bash
>php artisan serve
```

### 5. Run monitor and work queue

To make requests in time to api to know providers health status is need to execute.
```bash
php artisan schedule:work
```
and execute the jobs that was added to queue

```bash
php artisan queue:work
```

Now you can run the project to test all API endpoints.


### Tests

To execute the implemented tests you can run:

```bash
php artisan test
```
### Notes

### The provider health status is represented by an integer constant where
**OFFLINE** = 0
**ONLINE** = 1

## Endpoints

### 1. Add Provider

**Endpoint:**  
`POST /api/provider`

**Description:**  
Add a new provider to be monitored.

**Request Body:**

```json
{
  "url": "https://teste2.infura.io/v3/YOUR_PROJECT_ID",
  "name": "Teste2",
  "chain_id": "4"
}
```
### 2. Update Provider

**Endpoint:**  
`PUT /api/provider/{provider_id}`

**Description:**  
Edit specific provider that was already added.

**Request Body:**
```json
{
  "url": "new_url",
  "name": "new_name",
  "chain_id": "new_chainid"
}
```
### 3. Delete Provider

**Endpoint:**  
`DELETE /api/provider/{provider_id}`

**Description:**  
Remove provider from monitored list by id


### 4. Get Providers list

**Endpoint:**  
`GET /api/provider?status={status_value}&chain_id={chain_value}`

**Description:**  
Returns monitored providers using filter query by status and chain_id.

