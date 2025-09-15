import cgi, math

print("Content-Type: text/html\n")

form = cgi.FieldStorage()
try:
    a = float(form.getfirst("a"))
    b = float(form.getfirst("b"))
    c = float(form.getfirst("c"))

    c_cubed = c ** 3
    sqrt_val = c_cubed ** 0.5
    division = sqrt_val / a
    multiplication = division * 10
    result = multiplication + b

    print(f"""
    <html>
    <head><title>Result</title></head>
    <body>
        <h2>Calculation Result</h2>
        <p>a = {a}, b = {b}, c = {c}</p>
        <p>c^3 = {c_cubed}</p>
        <p>sqrt(c^3) = {sqrt_val}</p>
        <p>(sqrt(c^3)/a) * 10 = {multiplication}</p>
        <p>Final Result = {result}</p>
    </body>
    </html>
    """)
except:
    print("<html><body><p>Error: invalid input</p></body></html>")
