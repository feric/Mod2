user = ""
contrasenia = ""
def index():
    return dict()

def adentro():
    return dict()

def twitter():
    formulario = FORM('Usuario', INPUT(_name='usuario', requires=IS_NOT_EMPTY()),
                      'Password',INPUT(_name='passw',_type='password', requires=IS_NOT_EMPTY()),
                      INPUT(_type='submit',_value='Log in'))
    if formulario.process().accepted:
        user = formulario.vars.usuario
        contrasenia = formulario.vars.passw
        if user == "feric" and contrasenia == "feric":
            session.flash = 'okas'
            redirect(URL('adentro'))
        else:
            response.flash = 'Datos invalidos'
    elif formulario.errors:
        response.flash = 'Formulario incompleto'
    else:
        response.flash = 'por favor complete el formulario'
    return dict(form=formulario)

def facebook():
    formulario = FORM('Usuario', INPUT(_name='usuario', requires=IS_NOT_EMPTY()),
                      'Password',INPUT(_name='passw',_type='password', requires=IS_NOT_EMPTY()),
                      INPUT(_type='submit',_value='Log in'))
    if formulario.process().accepted:
        user = formulario.vars.usuario
        contrasenia = formulario.vars.passw
        if user == "feric" and contrasenia == "feric":
            session.flash = 'okas'
            redirect(URL('adentro'))
        else:
            response.flash = 'Datos invalidos'
    elif formulario.errors:
        response.flash = 'Formulario incompleto'
    else:
        response.flash = 'por favor complete el formulario'
    return dict(form=formulario)
