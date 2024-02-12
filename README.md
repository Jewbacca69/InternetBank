## Features

- Allows you to create debit and investment accounts.
- Allows you to create crypto wallets
- View your transactions
- Buy / Sell crypto
- Transfer funds to someone else or between your own accounts



## Installation

1. **Clone the Repository:**
   ```bash
      git clone https://github.com/your_username/repository_name.git
   ```
   
2. **Run:**
    ```bash
        composer install
    ```

3.  **Rename**
   Rename ```.env.example``` to ```.env``` and open it.

4.  **Update database details**
    ```
        DB_HOST=localhost
        DB_PORT=3306
        DB_DATABASE=your_database
        DB_USERNAME=your_username
        DB_PASSWORD=your_password
    ```
    
5. **API**
    Get an API key from : ```https://coinmarketcap.com/api/``` and and modify the following ```.env``` line : ```COINMARKETCAP_API_KEY=key_goes_here```

6. **Run:**
    ```bash
        php artisan migrate
    ```
    
7. **Update currency prices:**
    ```bash
        php artisan app:update-crypto-prices
    ```
    And
    
    ```bash
        php artisan app:update-crypto-prices
    ```
    
    **All done!**
    
    ## Images
    
    [![Image 1](https://i.gyazo.com/b9bc861984dcf13fa7badb27938963c2.png)](https://gyazo.com/b9bc861984dcf13fa7badb27938963c2)
