## Features

- Allows you to create debit and investment accounts.
- Allows you to create crypto wallets
- View your transactions
- Buy / Sell crypto
- Transfer funds to someone else or between your own accounts



## Installation

1. **Clone the Repository:**
   ```bash
      git clone https://github.com/Jewbacca69/InternetBank.git
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
        php artisan app:update-currency-prices
    ```
    
    **All done!**
    
    ## Images

   [![Image 1](https://i.gyazo.com/ccaeaae989ba7069841818a9ea4ef923.png)](https://gyazo.com/ccaeaae989ba7069841818a9ea4ef923)
   [![Image 2](https://i.gyazo.com/dc54f348802694f72ba973449957430f.png)](https://gyazo.com/dc54f348802694f72ba973449957430f)
   [![Image 3](https://i.gyazo.com/20b76d85c7e329cf840c85d785720cff.png)](https://gyazo.com/20b76d85c7e329cf840c85d785720cff)
   [![Image 4](https://i.gyazo.com/b9bc861984dcf13fa7badb27938963c2.png)](https://gyazo.com/b9bc861984dcf13fa7badb27938963c2)
