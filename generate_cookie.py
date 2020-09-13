import requests

print('please wait....')

res = requests.get('https://flipkart.com')

cookie = res.headers['Set-Cookie']

mob = input('\nEnter registered mobile number\n')

headers = {
    'X-user-agent': 'Mozilla/5.0 (Linux; Android 10; 1) AppleWebKit/57.36 (KHTML, like Gecko) Chrome/87.125 Mobile Safari/57.36FKUA/msite/0.0.3/msite/Mobile',
    'Content-Type': 'application/json',
    'cookie': ''+cookie+''}
    
data = '{"actionRequestContext":{"type":"LOGIN_IDENTITY_VERIFY","loginIdPrefix":"+91","loginId":"'+mob+'","clientQueryParamMap":{"ret":"/","entryPage":"HOMEPAGE_HEADER_ACCOUNT"},"loginType":"MOBILE","verificationType":"OTP","screenName":"LOGIN_V4_MOBILE","sourceContext":"DEFAULT"}}'

response = requests.post('https://1.rome.api.flipkart.com/1/action/view', headers=headers, data=data)

req = response.json()

rid = req['RESPONSE']['actionResponseContext']['requestId']

print("OTP request ID: ",rid)

print('OTP successfully sent to your mobile number ')

otp = input('\nEnter OTP\n')

data2 = '{"actionRequestContext":{"type":"LOGIN","loginIdPrefix":"+91","loginId":"'+mob+'","clientQueryParamMap":{"ret":"/","entryPage":"HOMEPAGE_HEADER_ACCOUNT"},"loginType":"MOBILE","verificationType":"OTP","screenName":"LOGIN_V4_OTP","churned":false,"sourceContext":"DEFAULT","otp":"'+otp+'","otpRequestId":"'+rid+'"}}'


response2 = requests.post('https://1.rome.api.flipkart.com/1/action/view', headers=headers, data=data2)

print('YOUR COOKIE IS:')


print(response2.headers['Set-Cookie'])
