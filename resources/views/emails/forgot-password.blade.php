
<body style="background-color: #f3f4f6; font-family: Arial, sans-serif;">
    <div style="max-width: 500px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <h2 style="font-size: 30px; font-weight: bolder; margin-bottom: 20px; text-align:center">Password Reset</h2>
        <p style="margin-top: 20px; text-align:center; padding-left:40px; padding-right:40px; font-size: 16px;">
            If you lost your account or wish to reset password, use the link below to get started.</p>
        <div style="text-align: center; margin-top: 50px; font-size: 16px; margin-bottom: 50px;">
            <a href="{{route('reset.password', $token)}}" style="display: inline-block; background-color: #3490dc; color: #ffffff; text-decoration: none; font-weight: bold; padding: 15px 50px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); font-size: 16px;">Reset Password</a>
        </div>
        <p style="text-align: center; margin-top: 20px; padding-left: 40px; padding-right: 40px; font-size: 10px; color: #6b7280;">If you did not request a password reset, you can safely ignore this email. Only a person with access to your email can reset your account password</p>

        <p style="text-align: center; margin-top: 70px; padding-left: 20px; padding-right: 20px; font-size: 10px; color: #6b7280;">In case the button doesn't work, copy this link and paste it into your browser's address bar: {{route('reset.password', $token)}}</p>
    </div>
</body>

