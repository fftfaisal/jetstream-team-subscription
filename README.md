<h1 align="center">Laravel Jetstream Team Subscription</h1>

## About

A straightforward interface to handle subscriptions and features consumption.

## Installation

### Requirements

`PHP >= 8.2 and Laravel 11.x or higher`

#### 1. Clone the repository
```bash
git clone https://github.com/fftfaisal/jetstream-team-subscription.git
``` 

#### 2. Install composer dependencies
```bash
composer install
```

#### 3. Migration and seed

```bash
cp .env.example .env
```

```bash
php artisan migrate --seed
```

#### 4. Install NPM dependencies
```bash

npm install && npm run dev
```

#### 5. Run the server
```bash
php artisan serve
```
## Configuration
open the `.env` file and set the following variables

```bash
STRIPE_KEY=
STRIPE_SECRET=
STRIPE_WEBHOOK_SECRET=
```

To setup stripe plans and features, open the `config/billing.php` file and set the following variables

```bash
STRIPE_BASIC_MONTHLY_PLAN=
STRIPE_BASIC_YEARLY_PLAN=
STRIPE_PREMIUM_MONTHLY_PLAN=
STRIPE_PREMIUM_YEARLY_PLAN=
STRIPE_GOLD_MONTHLY_PLAN=
STRIPE_GOLD_YEARLY_PLAN=
```

### That's it! You are ready to go.

