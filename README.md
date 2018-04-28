Shadow
======

# Create One-Time-Use token

`KEY="base64:LiaujZnUXXkqylg3wq6rH2M5eh6VaQh2w8OVhKB0UA8="`

`echo -n "http://localhost:8000/register?id=Ciuc7Hwfaiqum02w" | openssl dgst -sha256 -hmac $KEY`
