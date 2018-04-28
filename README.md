Shadow
======

# Create One-Time-Use token

Generate unique string ID for new user:

str_random();

then get APP_KEY from `.env` file:

`KEY="base64:LiaujZnUXXkqylg3wq6rH2M5eh6VaQh2w8OVhKB0UA8="`

and run this command:

`echo -n "http://localhost:8000/register?id=Ciuc7Hwfaiqum02w" | openssl dgst -sha256 -hmac $KEY`

Finally you will get signature for URL.
